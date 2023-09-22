<?php

namespace App\Services;

use DOMDocument;
use DOMElement;
use DOMNodeList;
use DOMXPath;
use Illuminate\Support\Facades\Http;

class ParserDOM implements ParserInterface{

    public $config;

    function __construct($configKey = 'parse.move'){
        $this->config = config($configKey);         //config('parse.move');
    }

    function parseDevelopers($single = false) :array | null
    {
        $developerArray = [];
        $develContainer = $this->getDeveloperContainer();
        /** DOMNodeList */
        $developerList = $develContainer->hasChildNodes() ? $develContainer->childNodes : null;
        if(!$developerList){
            return null;
        }
        $developersNodes = $this->getDeveloperNodes($developerList);
        $developersLinks =  array_map(function($el){
            return $el->getElementsByTagName('a')->item(0)->getAttribute('href');
        },$developersNodes);

        if($single){
            $developerArray[] = $this->parseDeveloperPage($this->config['base_link'].$developersLinks[0]);
        } else {
            foreach($developersLinks as $developerLink){
                $developerArray[] = $this->parseDeveloperPage($this->config['base_link'].$developerLink);
            }
        }
        return $developerArray;
    }


    function parseDeveloperPage($link){
        $developerPage = $this->getFromUrl($link);
        $dom = new DOMDocument;
        $dom->loadHTML($developerPage);
        $xpath = new DomXPath($dom);

        $title = trim($xpath->query('//*[@class="developer-item__row-data-name"]')?->item(0)?->textContent);
        $founded = trim($xpath->query('//*[@class="developer-item__row-data-year"]')?->item(0)?->textContent);
        $address = trim($xpath->query('//*[@class="developer-item__row-data-address"]')?->item(0)?->textContent);
        $developerSite = trim($xpath->query('//*[@class="developer-item__row-data-website"]/a')?->item(0)?->textContent);
        $regions = trim($xpath->query('//*[@class="developer-item__row-data-regions"]')?->item(0)?->textContent);
        $img = $xpath->query('//*[@class="developer-item__row-photo"]/a/img[@src]')?->item(0)?->getAttribute('src');

        return [
            'developer_link' => $link,
            'title' => $title,
            'founded' => $founded,
            'address' => $address,
            'developer_site' => $developerSite,
            'regions' => $regions,
            'img' => $img,
        ];
    }

    function parseAparts()
    {
        // TODO: Implement parse() method.
    }

    function parseApartsList($developerPageLink, $single = false, $suffix = '?no-filters=1'){

        $apparts = [];
        $apparts = $this->getAparts($developerPageLink.$suffix);
        dd($apparts);
//        if($appartsContainer){
//
//            dd($appartsContainer->ownerDocument);
//
//            $apartsList = $appartsContainer->hasChildNodes() ? $appartsContainer->childNodes : null;
//            if(!$apartsList){
//                return null;
//            }
//            $apartsListNodes = $this->getApartNodes($apartsList);
//
//            if($single){
//                $apparts[] = $this->parseApartNode($apartsListNodes[0]);
//            } else {
//                foreach($apartsListNodes as $apartsListNode){
//                    $apparts[] = $this->parseApartNode($apartsListNode);
//                }
//            }
//            return $apparts;
//        }
    }


    function parseApartNode(DOMElement $node){
        $xpath = new DomXPath($node->ownerDocument);

        $title = trim($xpath->query('//*[@class="items-list__row-data-name"]/a/span[last()]', $node)?->item(0)?->textContent);
        $pass = trim($xpath->query('//*[@class="items-list__row-data-name"]/a/span', $node)?->item(0)?->textContent);
        $apartLink = trim($xpath->query('//*[@class="items-list__row-data-name"]/a', $node)?->item(0)?->getAttribute('href'));
        $price = trim($xpath->query('//*[@class="prices-block__column price-main"]', $node)?->item(0)?->textContent);
        $content = trim($xpath->query('//*[@class="items-list__row-data-developer"]', $node)?->item(0)?->textContent);
        $city = trim($xpath->query("//*[contains(@class, 'geo-block-full__row-data-geo__line-item') and contains(@class, 'no-padding')]", $node)?->item(0)?->textContent);
        $class = trim($xpath->query('//*[@class="items-list__row-data-tags__tag"]', $node)?->item(0)?->textContent);
        $address = $content = trim($xpath->query('//*[@class="geo-block-full__row-data-geo__line-item"]', $node)?->item(0)?->textContent);
//        $images = $xpath->query('//*[@class="items-list__row-photo similar-novostroyki_row-photo"]', $node);
//        $imagesNodes = $xpath->query('//*[contains(@class, "items-list__row-photo") and contains(@class, "similar-novostroyki_row-photo")]', $node);

        return [
            'tile' => $title,
            'pass' => $pass,
            'apartLink' => $apartLink,
            'price' => $price,
            'content' => $content,
            'city' => $city,
            'class' => $class,
            'address' => $address,
        ];

    }

    function getAparts($developerLink){
        $page = $this->getFromUrl($developerLink);
        // херить ошибки
        $internalErrors = libxml_use_internal_errors(true);

        $dom = new DOMDocument;
        $dom->loadHTML($page);
        $xpath = new DomXPath($dom);

        $apartNodes = $xpath->query("//*[contains(@class, 'items-list') and contains(@class, 'similar-novostroyki')]/*[@class='items-list__row clearfix']");
        return $apartNodes;
    }

    function getDeveloperContainer(){

        $page = $this->getFromUrl($this->config['link']);
        // херить ошибки
        $internalErrors = libxml_use_internal_errors(true);

        $dom = new DOMDocument;
        $dom->loadHTML($page);

        $xpath = new DomXPath($dom);
        $containerDOMNodeList = $xpath->query(".//*[@class='{$this->config['developer_container_class']}']");
        /** DOMNodeList */

        return $containerDOMNodeList?->item(0);
    }


    function getDeveloperNodes(DOMNodeList $developerList){
        $nodes = [];
        foreach($developerList as $node){
            /** DOMText */
            if($node->nodeName == 'div'){
                if($node->getAttribute('class') == $this->config['developer_element_class']){
                    $nodes[] = $node;
                };
            };
        }
        return $nodes;
    }

    function getApartNodes(DOMNodeList $apartList){
        $nodes = [];
        foreach($apartList as $node){
            /** DOMText */
            if($node->nodeName == 'div' AND ($node->getAttribute('class') == 'items-list__row clearfix')){
                    $nodes[] = $node;
            };
        }
        return $nodes;
    }


    function getFromUrl($url, $args=[]){
        return Http::get($url)->body();
    }

}
