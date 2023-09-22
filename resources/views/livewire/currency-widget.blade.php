<div class="currency-widget">
    <h1>Валюта на сегодня:</h1>
    @foreach ($currency as $i=>$currencyItem)
        <div class="currencyItem flex space-between">
            <span class="currency-title">{{$currencyItem->CharCode}}</span>
            <span class="currency-current">{{$currencyItem->Value}}</span>
            <span class="currency-diff">
            @if($currencyItem->Value - $currencyItem->Previous > 0)
                {{ '+'. round($currencyItem->Value - $currencyItem->Previous,2) }}
            @else
                {{ round($currencyItem->Value - $currencyItem->Previous,2) }}
            @endif
            </span>
            <span class="arrow">{!! ($currencyItem->Value - $currencyItem->Previous) > 0 ? '&uarr;' : '&darr;'!!}</span>
        </div>
    @endforeach
</div>
