<?php

namespace App\Services;

use App\Http\Requests\RemoteApi\RemoteApiCreateRequest;
use App\Http\Requests\RemoteApi\RemoteApiUpdateRequest;
use App\Models\RemoteApi;
use App\Repositories\RemoteApiRepository;

class RemoteApiService
{
    protected RemoteApiRepository $repository;

    public function __construct(RemoteApiRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(RemoteApiCreateRequest $request)
    {
        return $this->repository->create($request->all());
    }

    public function update(RemoteApiUpdateRequest $request, RemoteApi $remote_api): RemoteApi
    {
        return $this->repository->update($remote_api, $request->all());
    }

    public function delete(RemoteApi $remote_api): void
    {
        $this->repository->delete($remote_api);
    }



}
