<?php

namespace MyanmarTownships\App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use MyanmarTownships\App\Resources\traits\RegionSerializer;

class Township extends JsonResource
{
    use RegionSerializer;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'township' => $this->serializeRegion($this),
            'district' => $this->whenLoaded('district',function (){
                return $this->serializeRegion($this->district);
            }),
            'state' => $this->when($this->relationLoaded('district') && $this->district->relationLoaded('state'), function () {
                return $this->serializeRegion($this->district->state);
            }),
        ];
    }
}
