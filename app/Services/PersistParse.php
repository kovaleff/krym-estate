<?php


namespace App\Services;


use App\Models\Apart;
use App\Models\ApartPhoto;
use App\Models\Developer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PersistParse
{

    function truncateDeveloperTable()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('developers')->truncate();
    }

    function truncateApartsTable()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('aparts')->truncate();
    }

    function truncateApartsImagesTable()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('apart_photos')->truncate();
    }

    function saveDeveloper(array $developerArr, $storage = 'public')
    {
        $devImagePath = config('parse.developers_image_path', 'developers/');

        $developer = new Developer($developerArr);
        $basename = basename($developer->image);
        //with no logo is not visible
        if($basename == 'no-logo.jpg'){
            $developer->is_visible = false;
        }
        Storage::disk($storage)->put($devImagePath.$basename, file_get_contents($developer->image));
        $developer->image = $devImagePath.$basename;
        $developer->save();
    }

    public function saveApartsAndImages(array $aparts)
    {
        foreach ($aparts as $apartArr) {
            $apart = new Apart(
                [
                    'title' => $apartArr['title'],
                    'parse_link' => null,
                    'link' => $apartArr['apartLink'] ?? null,
                    'city' => $apartArr['apartCity'] ?? null,
                    'phone' => $apartArr['phone'] ?? null,
                    'address' => null,
                    'content' => $apartArr['apartContent'] ?? null,
                    'attr' => $apartArr['attr'] ?? null,
                    'developer_id' => $apartArr['developer_id']

                ]
            );
            $apart->save();
            $this->addImagesToApart($apart, $apartArr);
        }

    }

    private function addImagesToApart($apart, $apartArr, $storageDisk = 'public')
    {
        $is_featured = true;
        $apartsImagePath = config('parse.aparts_image_path', 'aparts/');

        foreach ($apartArr['images'] as $imageLink) {

            $basename = basename($imageLink);
            Storage::disk($storageDisk)->put($apartsImagePath.$basename, file_get_contents($imageLink));

            $apartPhoto = new ApartPhoto(
                [
                    'image' => $apartsImagePath.$basename,
                    'apart_id' => $apart->id,
                    'is_featured' => $is_featured,

                ]
            );
            $apartPhoto->save();

            $is_featured = false;
        }

    }

}
