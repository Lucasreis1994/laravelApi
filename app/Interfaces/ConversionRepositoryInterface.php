<?php

namespace App\Interfaces;

interface ConversionRepositoryInterface 
{
    public function createConversion(array $conversionDetails);
    public function getAllConversionsByUser();
    public function deleteConversion($id);
}