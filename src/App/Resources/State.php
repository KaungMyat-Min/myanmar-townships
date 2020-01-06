<?php

namespace MyanmarTownships\App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use MyanmarTownships\App\Resources\traits\RegionSerializer;

class State extends JsonResource
{
    use RegionSerializer;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'state'=> $this->serializeRegion($this),
            'districts'=>District::collection($this->whenLoaded('districts'))
        ];
    }
}
