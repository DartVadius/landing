<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            'title' => 'Index',
            'slug' => 'index',
            'meta_title' => 'Index',
            'text' => 'Change this text',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'title' => 'Galleries',
            'slug' => 'galleries',
            'meta_title' => 'All Galleries',
            'text' => 'Change this text',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'title' => 'Blog',
            'slug' => 'blog',
            'meta_title' => 'Blog',
            'text' => 'Change this text',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
        DB::table('pages')->insert([
            'title' => 'About',
            'slug' => 'about',
            'meta_title' => 'About',
            'text' => 'Change this text',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ]);
    }
}
