<?php

namespace Database\Seeders;

use App\Models\RemoteApi;
use Illuminate\Database\Seeder;

class RemoteApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RemoteApi::create(['name' => 'meteo-weather','url' => 'https://api.open-meteo.com/v1/forecast']);
        RemoteApi::create(['name' => 'weather-api','url' => 'http://api.weatherapi.com/v1/forecast.json', 'api_key' => '7ce2b0892908491bbb5234550241301']);
    }
}
