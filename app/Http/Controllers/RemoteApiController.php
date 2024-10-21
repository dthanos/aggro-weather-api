<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemoteApi\RemoteApiCreateRequest;
use App\Http\Requests\RemoteApi\RemoteApiUpdateRequest;
use App\Http\Resources\RemoteApiResource;
use App\Models\RemoteApi;
use App\Services\RemoteApiService;

class RemoteApiController extends Controller
{

    /**
     * @var RemoteApiService
     */
    private RemoteApiService $remote_api_service;

    /**
     * @param RemoteApiService $remote_api_service
     */
    public function __construct(RemoteApiService $remote_api_service)
    {
        $this->remote_api_service = $remote_api_service;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return RemoteApiResource::collection(RemoteApi::all());
    }

    /**
     * @param RemoteApiCreateRequest $request
     * @return RemoteApiResource
     */
    public function store(RemoteApiCreateRequest $request): RemoteApiResource
    {
        return RemoteApiResource::make($this->remote_api_service->create($request));
    }

    /**
     * @param RemoteApi $remote_api
     * @return RemoteApiResource
     */
    public function show(RemoteApi $remote_api): RemoteApiResource
    {
        return RemoteApiResource::make($remote_api);
    }


    /**
     * @param RemoteApiUpdateRequest $request
     * @param RemoteApi $remote_api
     * @return RemoteApiResource
     */
    public function update(RemoteApiUpdateRequest $request, RemoteApi $remote_api): RemoteApiResource
    {
        return RemoteApiResource::make($this->remote_api_service->update($request, $remote_api));
    }

    /**
     * @param RemoteApi $remote_api
     * @return void
     */
    public function delete(RemoteApi $remote_api): void
    {
        $this->remote_api_service->delete($remote_api);
    }
}
