<?php

namespace App\Traits;
use Illuminate\Support\Facades\Http;

trait ApiConversion
{
    public function _get($targetCurrency){
        $url = 'https://economia.awesomeapi.com.br/json/last/'.$targetCurrency.'-'.config('conversion.originCurrency');
        
        $response = Http::get($url)->collect($key = $targetCurrency.config('conversion.originCurrency'));

        return $response;
    }
}