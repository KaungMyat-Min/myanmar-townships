<?php


namespace MyanmarTownships\App\Helpers;


use MyanmarTownships\App\Helpers\Contracts\MyanmarTownship;
use MyanmarTownships\App\Helpers\Facades\FontConverter;
use MyanmarTownships\App\Models\District;
use MyanmarTownships\App\Models\State;
use MyanmarTownships\App\Models\Township;
use MyanmarTownships\App\Resources\DistrictCollection;
use MyanmarTownships\App\Resources\StateCollection;
use MyanmarTownships\App\Resources\TownshipCollection;

class MyanmarTownshipImpl implements MyanmarTownship
{
    public function searchTownships($options)
    {
        if (!is_array($options)) {
            $options = ['q' => $options];
        }
        $options['model'] = Township::class;
        $options['with'] = ['district.state'];

        $result = $this->search($options);

        if ($this->isResourceResult($options)) {
            return new TownshipCollection($result);
        } else {
            return $result;
        }

    }

    public function searchDistricts($options)
    {
        if (!is_array($options)) {
            $options = ['q' => $options];
        }
        $options['model'] = District::class;
        $options['with'] = ['state','townships'];

        $result = $this->search($options);

        if ($this->isResourceResult($options)) {
            return new DistrictCollection($result);
        } else {
            return $result;
        }
    }

    public function searchStates($options)
    {
        if (!is_array($options)) {
            $options = ['q' => $options];
        }
        $options['model'] = State::class;
        $options['with'] = ['districts'];

        $result = $this->search($options);

        if ($this->isResourceResult($options)) {
            return new StateCollection($result);
        } else {
            return $result;
        }
    }

    private function isResourceResult($options){
        $is_resource_result = $this->extract_value_from_array('resource_result', $options);
        if ($is_resource_result === null) {
            $is_resource_result = config('myanmar-townships.resource_result', false);
        }
        return $is_resource_result;
    }
    private function search($options)
    {
        $model = $this->extract_value_from_array('model', $options);
        $with = $this->extract_value_from_array('with', $options);


        //values come from user request
        $q = $this->extract_value_from_array('q', $options);
        $sort = $this->extract_value_from_array('sort', $options, 'name_mm');
        $limit = $this->extract_value_from_array('limit', $options, 10);
        $order = $this->extract_value_from_array('order',$options,'asc');


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
            ->orderBy($sort,$order)
            ->limit($limit);

        return $query->get();
    }

    private function extract_value_from_array(string $key, array $array, $default = null)
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        } else {
            return $default;
        }
    }

}
