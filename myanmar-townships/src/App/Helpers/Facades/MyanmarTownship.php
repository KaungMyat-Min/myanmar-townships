<?php


namespace MyanmarTownships\App\Helpers\Facades;


use Illuminate\Support\Facades\Facade;

class MyanmarTownship extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \MyanmarTownships\App\Helpers\Contracts\MyanmarTownship::class;
    }
}
