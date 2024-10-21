<?php

namespace App\Repositories;

use App\Models\RemoteApi;

class RemoteApiRepository
{
    protected $remote_api;

    public function __construct()
    {
    }

    public function create($attributes)
    {
        $remote_api = RemoteApi::create($attributes);
        return $remote_api;
    }

    public function update(RemoteApi $remote_api, $attributes)
    {
        $remote_api->update($attributes);
        return $remote_api->refresh();
    }

    public function delete(RemoteApi $remote_api)
    {
        $remote_api->delete();
    }
}
