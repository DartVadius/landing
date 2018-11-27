<?php

namespace App\DB_Models;

use Illuminate\Database\Eloquent\Model;

class SliderPhoto extends Model
{
    protected $table = 'slider_photos';
    public $timestamps = false;

    public function slider()
    {
        return $this->belongsTo('App\DB_Models\Slider');
    }
}
