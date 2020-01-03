<?php

namespace MyanmarTownships\App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Township extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'name_eng' => $this->name_eng,
            'district' => $this->district->name,
            'state' => $this->district->state->name,
        ];
    }
}
