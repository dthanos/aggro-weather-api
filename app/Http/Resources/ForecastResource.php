<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ForecastResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
        [
            'id' => $this->id,
            'step' => $this->step,
            'temperature' => explode(',', $this->temperature),
            'precipitation' => explode(',', $this->precipitation),
            'datetime' => explode(',', $this->datetime),
            'location' => LocationResource::make($this->location),
            'remote_api' => RemoteApiResource::make($this->remote_api),
        ];
    }
}
