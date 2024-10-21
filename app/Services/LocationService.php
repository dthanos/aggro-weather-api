<?php

namespace App\Services;

use App\Http\Requests\Location\LocationCreateRequest;
use App\Http\Requests\Location\LocationUpdateRequest;
use App\Models\Location;
use App\Repositories\LocationRepository;

class LocationService
{
    protected LocationRepository $repository;

    public function __construct(LocationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(LocationCreateRequest $request)
    {
        return $this->repository->create($request->all());
    }

    public function update(LocationUpdateRequest $request, Location $location): Location
    {
        return $this->repository->update($location, $request->all());
    }

    public function delete(Location $location): void
    {
        $this->repository->delete($location);
    }



}
