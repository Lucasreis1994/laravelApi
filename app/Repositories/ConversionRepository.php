<?php

namespace App\Repositories;

use App\Interfaces\ConversionRepositoryInterface;
use App\Models\Conversion;
use Illuminate\Support\Facades\Auth;

class ConversionRepository implements ConversionRepositoryInterface 
{
    public function createConversion($conversionDetails){
        Conversion::create($conversionDetails);
    }
    
    public function getAllConversionsByUser(){
        return Conversion::where('user_id', Auth::user()->id)->get();
    }

    public function deleteConversion($id){
        Conversion::destroy($id);
    }
}