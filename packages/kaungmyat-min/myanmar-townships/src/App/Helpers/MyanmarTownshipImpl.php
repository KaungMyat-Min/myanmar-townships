<?php


namespace MyanmarTownships\App\Helpers;


use MyanmarTownships\App\Helpers\Contracts\MyanmarTownship;
use MyanmarTownships\App\Models\Township;

class MyanmarTownshipImpl implements MyanmarTownship
{
    public function searchTownships($options)
    {
        $model = Township::class;
        $with = ['district.state'];

        if (is_array($options)) {
            $q = $this->extract_value_from_array('q', $options);
            $sort = $this->extract_value_from_array('sort', $options, 'name_mm');
            $limit = $this->extract_value_from_array('limit', $options, 10);
        } else {
            $q = $options;
            $sort = 'name_mm';
            $limit = 10;
        }

        return $this->search($model, $q, $with, $sort, $limit);
    }

    public function searchDistricts($options)
    {
        // TODO: Implement searchDistricts() method.
    }

    public function searchStates($options)
    {
        // TODO: Implement searchStates() method.
    }

    public function search($model, $q, $with = [], $sort = 'name', $limit = 10)
    {

        return $model::where('name_mm', 'like', "%$q%")
            ->orWhere('name_en','like',"%$q%")
            ->with($with)
            ->orderBy($sort)
            ->limit($limit)->get();
    }

    function extract_value_from_array(string $key, array $array, $default = null)
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        } else {
            return $default;
        }
    }

}
