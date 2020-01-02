<?php

namespace MyanmarTownships\App\Models;


use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    protected $fillable = [
        'district_id',
        'name_mm',
        'name_en'
    ];

    public $timestamps = false;

    public function district()
    {
        return $this->belongsTo(District::class);
    }

//    public function students()
//    {
//        return $this->morphedByMany(StudentDetail::class, 'model');
//    }
}
