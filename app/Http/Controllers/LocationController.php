<?php

namespace App\Http\Controllers;

use App\Http\Requests\Location\LocationCreateRequest;
use App\Http\Requests\Location\LocationUpdateRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Services\LocationService;

class LocationController extends Controller
{

    /**
     * @var LocationService
     */
    private LocationService $location_service;

    /**
     * @param LocationService $location_service
     */
    public function __construct(LocationService $location_service)
    {
        $this->location_service = $location_service;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return LocationResource::collection(Location::all());
    }

    /**
     * @param LocationCreateRequest $request
     * @return LocationResource
     */
    public function store(LocationCreateRequest $request): LocationResource
    {
        return LocationResource::make($this->location_service->create($request));
    }

    /**
     * @param Location $location
     * @return LocationResource
     */
    public function show(Location $location): LocationResource
    {
        return LocationResource::make($location);
    }


    /**
     * @param LocationUpdateRequest $request
     * @param Location $location
     * @return LocationResource
     */
    public function update(LocationUpdateRequest $request, Location $location): LocationResource
    {
        return LocationResource::make($this->location_service->update($request, $location));
    }

    /**
     * @param Location $location
     * @return void
     */
    public function delete(Location $location): void
    {
        $this->location_service->delete($location);
    }
}
