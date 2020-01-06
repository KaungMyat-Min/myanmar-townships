<?php


namespace MyanmarTownships\App\Helpers\Facades;


use Illuminate\Support\Facades\Facade;

class FontConverter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return config('myanmar-townships.font_converter');
    }

}
