<?php

namespace App\Services;

use App\Interfaces\ConversionRepositoryInterface;

use App\Traits\ApiConversion;
use Illuminate\Support\Facades\Auth;

class ConversionService
{

    use ApiConversion;

    protected $conversionRepository;

    public function __construct(ConversionRepositoryInterface $conversionRepository)
    {
        $this->conversionRepository = $conversionRepository;
    }

    private function payTax($paymentMethod, $conversionValue){ // 1 = boleto, 2 = cartão de crédito
        $tax = $paymentMethod == '1' ? config('conversion.taxPercentBillet') : config('conversion.taxPercentCreditCard');

        return $conversionValue * ( $tax / 100 );
    }

    private function conversionTax($conversionValue){ 
        $tax = $conversionValue < 3000 ? 2 : 1;

        return $conversionValue * ( $tax / 100 );
    }

    private function conversionValueDiscoutingTaxes($payTax, $conversionTax, $conversionValue){
        return $conversionValue - $payTax - $conversionTax;
    }
    
    private function valuePurchased($conversionValueDiscoutingTaxes, $bid){
        return $conversionValueDiscoutingTaxes / $bid;
    }

    public function createConversion($request){

        $responseApi = $this->_get($request->targetCurrency);
        $bid         = $responseApi['bid'];

        $conversionValue = $request->conversionValue;
        $paymentMethod   = $request->paymentMethod;

        $payTax                         = $this->payTax($paymentMethod, $conversionValue);
        $conversionTax                  = $this->conversionTax($conversionValue);
        $conversionValueDiscoutingTaxes = $this->conversionValueDiscoutingTaxes($payTax, $conversionTax, $conversionValue);
        $valuePurchased                 = $this->valuePurchased($conversionValueDiscoutingTaxes, $bid);

        $data = [
            'user_id'                       => Auth::user()->id,
            'originCurrency'                => config('conversion.originCurrency'),
            'targetCurrency'                => $request->targetCurrency,
            'conversionValue'               => $conversionValue,
            'paymentMethod'                 => $paymentMethod,
            'valueOriginCurrency'           => round($bid,2),
            'valueTargetCurrency'           => round($valuePurchased,2),
            'payTax'                        => round($payTax,2),
            'conversionTax'                 => round($conversionTax,2),
            'valueConversionDiscountingTax' => round($conversionValueDiscoutingTaxes,2),
        ];

        $this->conversionRepository->createConversion($data);

        return $data;
    }

    public function getAllConversionsByUser(){
        return $this->conversionRepository->getAllConversionsByUser();
    }

    public function deleteConversion($id){
        return $this->conversionRepository->deleteConversion($id);
    }

}