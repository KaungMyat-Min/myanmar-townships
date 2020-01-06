<?php

namespace MyanmarTownships\App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'name_mm',
        'name_en'
    ];

    public $timestamps = false;

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function townships()
    {
        return $this->hasManyThrough(
            Township::class,
            District::class
        );
    }
}
