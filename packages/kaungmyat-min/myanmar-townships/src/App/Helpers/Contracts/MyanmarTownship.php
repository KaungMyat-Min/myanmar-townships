<?php


namespace MyanmarTownships\App\Helpers\Contracts;


interface MyanmarTownship
{
    public function searchTownships($options);

    public function searchDistricts($options);

    public function searchStates($options);


}
