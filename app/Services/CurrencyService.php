<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class CurrencyService
{
    public string $apiUrl;

    function __construct(string $apiUrl = 'https://www.cbr-xml-daily.ru/daily_json.js'){

        $this->apiUrl = $apiUrl;
    }

    function getJson(){
        return Http::get($this->apiUrl)->body();
    }

}
