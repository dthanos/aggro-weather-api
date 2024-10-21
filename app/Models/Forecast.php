<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'temperature',
        'precipitation',
        'datetime',
        'step',
        'location_id',
        'remote_api_id',
    ];


    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function remote_api()
    {
        return $this->belongsTo(RemoteApi::class, 'remote_api_id');
    }
}
