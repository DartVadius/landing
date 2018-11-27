<?php

namespace App\DB_Models;

use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $table = 'pages';

    use FormAccessible;

    public static function setup($data, $id = null) {
        if ($id) {
            $page = Page::find($id);
        } else {
            $page = new self();
        }

        foreach ($data as $key => $value) {
            $page->{$key} = $value;
        }
        if (empty($page->created_at)) {
            $page->created_at = date("Y-m-d H:i:s");
        }
        $page->updated_at = date("Y-m-d H:i:s");
        return $page;
    }

}
