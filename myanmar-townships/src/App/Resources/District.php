<?php

namespace MyanmarTownships\App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use MyanmarTownships\App\Resources\traits\RegionSerializer;
use function foo\func;

class District extends JsonResource
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
            'district' => $this->serializeRegion($this),
            'state' => $this->whenLoaded('state', function () {
                return $this->serializeRegion($this->state);
            }),
            'townships' => Township::collection($this->whenLoaded('townships'))
        ];
    }
}
