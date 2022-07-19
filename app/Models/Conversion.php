<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    use HasFactory;

    protected $table = 'conversions';
    
    protected $fillable = [
        'user_id',
        'originCurrency',
        'targetCurrency',
        'conversionValue',
        'paymentMethod',
        'valueOriginCurrency',
        'valueTargetCurrency',
        'payTax',
        'conversionTax',
        'valueConversionDiscountingTax'
    ];

    public function targetCurrency($targetCurrency = null)
    {
        $arrTargetCurrency = [
            config('conversion.targetCurrencyUSD'), 
            config('conversion.targetCurrencyEUR')
        ];
    
        if (!$targetCurrency)
            return $arrTargetCurrency;
        
        return $arrTargetCurrency[$targetCurrency];
    }
}
