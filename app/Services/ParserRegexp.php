<?php


namespace App\Services;


use App\Models\Apart;
use App\Models\ApartPhoto;
use App\Models\Developer;
use App\Models\Scanjob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ParserRegexp implements ParserInterface
{
    public PersistParse $persist;

    function __construct($configKey = 'parse.move')
    {
        set_time_limit(0);
        $this->config = config($configKey);         //config('parse.move');
        $this->persist = new PersistParse();
    }

    function getFromUrl($url, $args = [])
    {
        $respose = Http::get($url)->body();
        return $respose;
    }



    function parseDevelopers(bool $single = false, bool $truncateTable = false)
    {

        $scanjob = Scanjob::where('type', 'developers')->firstOrFail();
        $scanjob->percents = (int)0;
        $scanjob->save();

        $pageWithDevelopers = $this->getFromUrl($this->config['link']);
        //developers link array
        preg_match_all(
            '/<div\s+class="items-list__line">\s*.*\s*<\/div>\s*.*\s*<\/div>\s*.*\s*<\/div>/im',
            $pageWithDevelopers, $matches,
        );
        $developersMatched = $matches[0];

        $developersLinks = [];

        if ($developersMatched) {
            foreach ($developersMatched as $developerHtml) {
                $matched = preg_match('/a\s+class="items-list__data__title"\s+href="(.*?)">\s+(.*?)\s+<\/a>/im', $developerHtml, $matches);
                if ($matched) {
                    $developerLink = $matches[1];
                    $developerTitle = $matches[2];
                    $developersLinks[] = config('parse.move.base_link') . $developerLink;
                }
            }
        }

        $totalTasks = count($developersLinks);
        $percentDone = 0;

        $developers = [];
        if($truncateTable){
            $this->persist->truncateDeveloperTable();
        }
        foreach ($developersLinks as $i => $developerLink) {
            $developerFound = Developer::where('developer_link', $developerLink)->first();
            if ($developerFound?->id) continue;
            $pageWithDevelopers = $this->getFromUrl($developerLink);

            $matches = null;
            $matched = preg_match('/class="developer-item">.*?Показать\s+телефон/ims', $pageWithDevelopers, $matches);
            if ($matched) {
                $developerHtml = $matches[0];

                $matched = preg_match('/"developer-item__row-data-name">\s+(.*?)\s+<\//', $developerHtml, $matches);
                $developerTitle = $matched ? $matches[1] : null;

                $matched = preg_match('/"developer-item__row-photo">\s+.*?src="(.*?)"/', $developerHtml, $matches);
                $developerLogo = $matched ? $matches[1] : null;

                $matched = preg_match('/"developer-item__row-data-year">\s+(.*?)\s+<\//', $developerHtml, $matches);
                $developerFounded = $matched ? strip_tags($matches[1]) : null;

                $matched = preg_match('/developer-item__row-data-address">\s+(.*?)\s+<\//', $developerHtml, $matches);
                $developerAddress = $matched ? strip_tags($matches[1]) : null;
                $matched = preg_match('/"developer-item__row-data-website">\s+.*? href="(.*?)".*?<\//', $developerHtml, $matches);
                $developerSite = $matched ? strip_tags($matches[1]) : null;

                $matched = preg_match('/"developer-item__row-data-regions">\s+(.*?)\s+<\//', $developerHtml, $matches);
                $developerRegions = $matched ? strip_tags($matches[1]) : null;

                $matched = preg_match('/developer-item__row-data-phone-block".*?\s+data-id="(.*?)"/', $developerHtml, $matches);
                $developerPhoneId = $matched ? $matches[1] : null;

                if ($developerPhoneId) {
                    $developerPhone = null;
                    $phoneContent = $this->getFromUrl(config('parse.move.base_link') . "/api/v3/developers/get_phone/?id={$developerPhoneId}");
                    if ($phoneContent) {
                        $developerPhone = json_decode($phoneContent)?->data?->format[0];
                    }
                }
            }
            $developer = [
                'title' => $developerTitle,
                'image' => $developerLogo,
                'founded' => $developerFounded,
                'siteurl' => $developerSite,
                'developer_link' => $developerLink,
                'content' => $developerRegions,
                'regions' => Str::limit($developerRegions, 200),
                'phone' => $developerPhone,
                'address' => $developerAddress
            ];

            $percentDone += (int)100 / $totalTasks;
            $scanjob->percents = (int)$percentDone;
            $scanjob->save();

            // save it!
            $this->persist->saveDeveloper($developer);
            if($single) break;
        }

        $scanjob->percents = 0;
        $scanjob->save();
    }

    function parseAparts($single = f){
        $developers = Developer::all();
        $apartsMaxDeveloperId = DB::table('aparts')->max('developer_id') ?? 0;

        foreach ($developers as $developer) {
            $apartsForAllDevelopers[] = $this->parseApartsForDeveloper($developer);
            if ($single) break;
        }
    }

    function clearApartsAndPhotosTables(){
        $this->persist->truncateApartsTable();
        $this->persist->truncateApartsImagesTable();
    }

    function parseApartsForDeveloper(Developer $developer){
        $developerPage = $this->getFromUrl($developer->developer_link . '?limit=100&no-filters=1');
        $matched = preg_match_all(
            '/items-list__row clearfix">\s+.*?\s+<\/div>\s+<\/div>\s+<\/div>\s+<\/div>.*?\s+<\/div>\s+<\/div>\s+<\/div>/ims', $developerPage, $matches
        );
        $aparts = [];
        // cycle thru aparts
        if ($matched) {
            $apartHtmls = $matches[0];
            foreach ($apartHtmls as $apartHtml) {
                $matched = preg_match('/items-list__row-data similar-novostroyki_row-info">\s+.*\s+/ims', $apartHtml, $matches);

                if ($matched) {
                    $infoHtml = $matches[0];
                    $matched = preg_match('/href="(.*?)"/ims', $apartHtml, $matches);
                    $apartLink = $matched ? $matches[1] : null;

                    $matched = preg_match('/items-list__row-data-name">.*?\s+<span.*?>\s+(.*?)<\/span><span>(.*?)<\/span>/ims', $apartHtml, $matches);
                    $apartPass = $matched ? $matches[1] : null;
                    $apartCity = $matched ? $matches[2] : null;

                    $matched = preg_match('/items-list__row-data-developer">\s+(.*?)\s+<\/div/ims', $apartHtml, $matches);
                    $apartContent = $matched ? strip_tags($matches[1]) : null;

                    if ($apartLink) {
                        $apartHtmlPage = $this->getFromUrl($apartLink);
                        $imageLinks = [];
                        $matched = preg_match_all('/style="background:\s*url\((.*?[^)])"/ims', $apartHtmlPage, $matches);
                        if ($matched) {
                            foreach ($matches[1] as $im) {
                                $imageLinks[] = substr($im, 0, strpos($im, ')'));
                            }
                        };
                        $matched = preg_match_all('/admin-item__property__table-row-values">\s+(.*?)\s+<\//', $apartHtmlPage, $matches);
                        $apartAttrValues = $matched ? $matches[1] : null;

                        $matched = preg_match_all('/admin-item__property__table-row-title">(.*?)<\//', $apartHtmlPage, $matches);
                        $apartAttrTitles = $matched ? $matches[1] : null;

                        $apartAttr = array_combine($apartAttrTitles,$apartAttrValues);

                        $matched = preg_match('/data-phone="(.*?)"/', $apartHtmlPage, $matches);
                        $apartPhone = $matched ? $matches[1] : null;
                    }


                    $aparts[] = [
                        'developer_id' => $developer->id,
                        'title' => $apartCity,
                        'apartLink' => trim($apartLink, '//'),
                        'apartPass' => $apartPass,
                        'apartCity' => $apartCity,
                        'apartContent' => $apartContent,
                        'images' => $imageLinks,
                        'attr' => $apartAttr,
                        'phone' => $apartPhone,
                        'parse_link' => null,
                    ];

                }
            };
        }
        //persist aparts and its images;
        $this->persist->saveApartsAndImages($aparts);
    }
}
