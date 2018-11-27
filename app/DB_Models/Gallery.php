<?php

namespace App\DB_Models;

use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;
use Carbon\Carbon;

class Gallery extends Model {

    const CREATED_AT = 'date_create';
    const UPDATED_AT = 'date_update';

    protected $table = 'galleries';

    use FormAccessible;

    public function photos() {
        return $this->hasMany('App\DB_Models\Photo', 'gallery_id');
    }

    public static function setup($data, $id = null) {
        if ($id) {
            $gallery = Gallery::find($id);
        } else {
            $gallery = new self();
        }

        foreach ($data as $key => $value) {
            $gallery->{$key} = $value;
        }
        if (empty($gallery->date_create)) {
            $gallery->date_create = date("Y-m-d H:i:s");
        }
        $gallery->date_update = date("Y-m-d H:i:s");
        return $gallery;
    }

}
