<?php


namespace MyanmarTownships\App\Resources\traits;


trait RegionSerializer
{
    protected function serializeRegion($model)
    {
        return [
            'id'=>$model->id,
            'name_mm'=>$model->name_mm,
            'name_en'=>$model->name_en
        ];
    }
}