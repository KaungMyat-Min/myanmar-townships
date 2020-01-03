<?php


namespace MyanmarTownships\App\Helpers;


use MyanmarTownships\App\Helpers\Contracts\MyanmarTownship;
use MyanmarTownships\App\Helpers\Facades\FontConverter;
use MyanmarTownships\App\Models\Township;

class MyanmarTownshipImpl implements MyanmarTownship
{
    public function searchTownships($options)
    {
        if (!is_array($options)) {
            $options = ['q' => $options];
        }
        $model = Township::class;
        $with = ['district.state'];

        $q = $this->extract_value_from_array('q', $options);
        $sort = $this->extract_value_from_array('sort', $options, 'name_mm');
        $limit = $this->extract_value_from_array('limit', $options, 10);

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
        $search_by_english = config('myanmar-townships.search_by_english');
        $search_by_zawgyi = config('myanmar-townships.search_by_zawgyi');
        $search_by_unicode = config('myanmar-townships.search_by_unicode');

        if ($search_by_zawgyi) {
            $q = FontConverter::convertToUnicode($q, true);
        }

        $query = $model::query()
            ->when(($search_by_unicode || $search_by_zawgyi), function ($query) use ($q) {
                return $query->where('name_mm', 'like', "%$q%");
            })
            ->when($search_by_english, function ($query) use ($q) {
                return $query->orWhere('name_en', 'like', "%$q%");
            })
            ->with($with)
            ->orderBy($sort)
            ->limit($limit);

        return $query->get();
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
