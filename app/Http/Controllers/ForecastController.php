<?php

namespace App\Http\Controllers;

use App\Http\Resources\ForecastResource;
use App\Models\Forecast;
use App\Services\ForecastService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;

class ForecastController extends Controller
{

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ForecastResource::collection(Forecast::all());
    }


    /**
     * @return JsonResponse
     */
    public function run(): \Illuminate\Http\JsonResponse
    {
        Artisan::call('forecast:hourly-daily', []);
        return response()->json(['message' => 'ok']);
    }
}
