<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RemoteApi extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'url',
        'api_key',
    ];

    public function forecasts()
    {
        return $this->hasMany(Forecast::class, 'remote_api_id');
    }

}
