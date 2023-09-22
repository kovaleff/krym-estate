<?php

namespace App\Http\Livewire;

use App\Services\CurrencyService;
use Livewire\Component;

class CurrencyWidget extends Component
{
    public function render(CurrencyService $currency)
    {
        $currencyJson =  $currency->getJson();
        $objCurrency = json_decode($currencyJson);
        $currency = [
            'EUR' => $objCurrency->Valute->EUR,
            'USD' => $objCurrency->Valute->USD,
        ];

        return view('livewire.currency-widget', ['currency' => $currency]);
    }
}
