<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Services\ConversionService;
use App\Http\Requests\ConversionRequest;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class ConversionExchangeController extends Controller
{

    private ConversionService $conversionService;

    public function __construct(ConversionService $conversionService) 
    {
        $this->conversionService = $conversionService;
    }

    public function index(){

        return response()->json([
            'data' => $this->conversionService->getAllConversionsByUser()
        ]);

    }

    public function store(ConversionRequest $request)
    {

        return response()->json(
            [
                'data' => $this->conversionService->createConversion($request)
            ],
            Response::HTTP_CREATED
        );

    }

    public function delete(Request $request) 
    {
        $id = $request->id;
        $this->conversionService->deleteConversion($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
