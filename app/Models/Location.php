<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'longitude',
        'latitude',
    ];

    public function forecasts()
    {
        return $this->hasMany(Forecast::class, 'location_id');
    }
}
