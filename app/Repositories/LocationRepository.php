<?php

namespace App\Repositories;

use App\Models\Location;

class LocationRepository
{
    protected $location;

    public function __construct()
    {
    }

    public function create($attributes)
    {
        return Location::create($attributes);
    }

    public function update(Location $location, $attributes)
    {
        $location->update($attributes);
        return $location->refresh();
    }

    public function delete(Location $location)
    {
        $location->delete();
    }
}
