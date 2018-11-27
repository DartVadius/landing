<?php

namespace App\DB_Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    public $timestamps = false;

    public function SliderPhotos() {
        return $this->hasMany('App\DB_Models\SliderPhoto', 'slider_id');
    }
}
