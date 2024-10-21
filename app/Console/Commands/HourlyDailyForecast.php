<?php

namespace App\Console\Commands;

use App\Enums\ForecastStep;
use App\Models\Forecast;
use App\Models\Location;
use App\Models\RemoteApi;
use App\Repositories\ForecastRepository;
use App\Util\Helper;
use Illuminate\Console\Command;

class HourlyDailyForecast extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forecast:hourly-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'An hourly and daily forecast at 09:00';

    protected $forecast_repository;
    /**
     * Execute the console command.
     */
    public function handle()
    {
        Forecast::query()->delete();
        $this->forecast_repository = new ForecastRepository;
        $remote_apis = RemoteApi::all();
        Location::all()->map(function($location)use($remote_apis){// Looping through all locations
            $remote_apis->map(function ($remote_api)use($location){// Looping through all APIs for each location
                $relation_ids = ['location_id' => $location->id, 'remote_api_id' => $remote_api->id];
                switch($remote_api->name){
                    case 'meteo-weather':
                        // Daily
                        $result = Helper::curlWrapper($remote_api->url, 'GET', [
                            'daily' => 'temperature_2m_max,precipitation_sum',
                            'longitude' => strval($location->longitude),
                            'latitude' => strval($location->latitude)
                        ]);
                        $this->forecast_repository->create(array_merge($relation_ids, [
                            'step' => ForecastStep::Daily->name,
                            'datetime' => implode(',', $result['daily']['time']),
                            'temperature' => implode(',', $result['daily']['temperature_2m_max']),
                            'precipitation' => implode(',', $result['daily']['precipitation_sum']),
                        ]));

                        // Hourly
                        $result = Helper::curlWrapper($remote_api->url, 'GET', [
                            'hourly' => 'temperature_2m,precipitation',
                            'longitude' => strval($location->longitude),
                            'latitude' => strval($location->latitude)
                        ]);
                        $this->forecast_repository->create(array_merge($relation_ids, [
                            'step' => ForecastStep::Hourly->name,
                            'datetime' => implode(',', $result['hourly']['time']),
                            'temperature' => implode(',', $result['hourly']['temperature_2m']),
                            'precipitation' => implode(',', $result['hourly']['precipitation']),
                        ]));
                        break;
                    case 'weather-api':
                        $result = Helper::curlWrapper($remote_api->url, 'GET', [
                            'key' => strval($remote_api->api_key),
                            'q' => $location->latitude .','. $location->longitude,
                            'days' => '7' // TODO: can be customized to fit our needs
                        ]);
                        $forecast = collect($result['forecast']['forecastday']);

                        // Plucking the weather data results fetched from the API to fit our hourly and daily forecast structure
                        $this->forecast_repository->create(array_merge($relation_ids, [
                            'step' => ForecastStep::Daily->name,
                            'datetime' => implode(',', $forecast->pluck('date')->toArray()),
                            'temperature' => implode(',', $forecast->pluck('day.avgtemp_c')->toArray()),
                            'precipitation' => implode(',', $forecast->pluck('day.totalprecip_mm')->toArray()),
                        ]));
                        $this->forecast_repository->create(array_merge($relation_ids, [
                            'step' => ForecastStep::Hourly->name,
                            'datetime' => implode(',', $forecast->pluck('hour')->flatten(1)->pluck('time')->toArray()),
                            'temperature' => implode(',', $forecast->pluck('hour')->flatten(1)->pluck('temp_c')->toArray()),
                            'precipitation' => implode(',', $forecast->pluck('hour')->flatten(1)->pluck('precip_mm')->toArray()),
                        ]));
                        break;
                    default:
                        break;
                }

            });
        });
    }
}
