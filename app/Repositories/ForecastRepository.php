<?php

namespace App\Repositories;

use App\Models\Forecast;

class ForecastRepository
{
    protected $forecast;

    public function __construct()
    {
    }

    public function create($attributes)
    {
        return Forecast::create($attributes);
    }

}
