<?php
/**
 * Created by PhpStorm.
 * User: dartvadius
 * Date: 10.02.18
 * Time: 21:25
 */

namespace App\Http\Controllers\Frontend;

use App\DB_Models\Gallery;
use App\DB_Models\Page;
use App\DB_Models\Photo;
use App\DB_Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller {
    public function index() {
        $values = null;
        $photos = Photo::all();
        $page = Page::where('title', 'Index')->first();
        $about = Page::where('title', 'About')->first();
        if ($photos->count() > 0) {
            $values = $photos->random(8);
        }
        return view('frontend.index', ['photos' => $values, 'page' => $page, 'about' => $about]);
    }

    public function galleries() {
        $galleries = Gallery::orderBy('date_create', 'desc')->paginate(2);
        $page = Page::where('title', 'Galleries')->first();
        $about = Page::where('title', 'About')->first();
        return view('frontend.galleries', ['galleries' => $galleries, 'page' => $page, 'about' => $about]);
    }

    public function posts() {
        $posts = Post::orderBy('date_create', 'desc')->paginate(2);
        $page = Page::where('title', 'Blog')->first();
        $about = Page::where('title', 'About')->first();
        return view('frontend.posts', ['posts' => $posts, 'page' => $page, 'about' => $about]);
    }

    public function gallery_view($slug) {
        $gallery = Gallery::where('slug', $slug)->first();
//        $photos = $gallery->photos;
        $about = Page::where('title', 'About')->first();
        return view('frontend.gallery', ['gallery' => $gallery, 'about' => $about]);
    }

    public function post_view($slug) {
        $post = Post::all()->where('slug', $slug)->first();
        $about = Page::where('title', 'About')->first();
        return view('frontend.post', ['post' => $post, 'about' => $about]);
    }

    public function send_message(Request $request) {
        print_r($request->get('name'));
        die;
    }

}