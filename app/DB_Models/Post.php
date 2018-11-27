<?php

namespace App\DB_Models;

use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const CREATED_AT = 'date_create';
    const UPDATED_AT = 'date_update';

    protected $table = 'posts';

    use FormAccessible;

    public static function setup($data, $id = null) {
        if ($id) {
            $post = Post::find($id);
        } else {
            $post = new self();
        }

        foreach ($data as $key => $value) {
            $post->{$key} = $value;
        }
        if (empty($post->date_create)) {
            $post->date_create = date("Y-m-d H:i:s");
        }
        $post->date_update = date("Y-m-d H:i:s");
        return $post;
    }

}
