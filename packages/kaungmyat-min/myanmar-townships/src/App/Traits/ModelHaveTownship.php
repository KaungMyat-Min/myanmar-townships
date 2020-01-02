<?php


namespace MyanmarTownships\App\Traits;

use MyanmarTownships\App\Models\Township;

trait ModelHaveTownship
{
    public function township()
    {
        return $this->morphToMany(Township::class, 'model','model_township');
    }

    public function saveTownship($township)
    {
        if (is_numeric($township)) {
            return $this->townshipModel()->sync([$township]);
        } else {
            return $township;
        }
    }
}
