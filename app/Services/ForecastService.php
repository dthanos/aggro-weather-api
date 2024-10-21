<?php

namespace App\Services;

use App\Repositories\ForecastRepository;

class ForecastService
{
    protected ForecastRepository $repository;

    public function __construct()
    {
        $this->repository = new ForecastRepository;
    }

    public function create($attributes = [])
    {
        // TODO: The command could be embedded here to be called on demand as well
    }

}
