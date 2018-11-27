<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Frontend\IndexController@index')->name('index');
Route::get('/galleries', 'Frontend\IndexController@galleries')->name('galleries');
Route::get('/gallery/{slug}', 'Frontend\IndexController@gallery_view')->name('gallery_view');
Route::get('/posts', 'Frontend\IndexController@posts')->name('posts');
Route::post('/send-message', 'Frontend\IndexController@send_message')->name('send_message');
Route::get('/post/{slug}', 'Frontend\IndexController@post_view')->name('post_view');

Auth::routes();
Route::get('/auth/success', 'Auth\RegisterController@success')->name('success');

Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Backend',
        'middleware' => ['auth', 'can:role-admin']
    ],
    function () {
        Route::get('/', 'AdminController@index')->name('admin');
        Route::get('/gallery', 'GalleryController@index')->name('gallery');
        Route::get('/gallery/create', 'GalleryController@create')->name('gallery_create');
        Route::post('/gallery/store', 'GalleryController@store')->name('gallery_store');
        Route::get('/gallery/edit/{id}', 'GalleryController@edit')->name('gallery_edit');
        Route::post('/gallery/update/{id}', 'GalleryController@update')->name('gallery_update');
        Route::get('/gallery/destroy/{id}', 'GalleryController@destroy')->name('gallery_destroy');
        Route::post('/gallery/add_photos/{id}', 'GalleryController@add_photos')->name('gallery_add_photos');
        Route::get('/photo/edit/{photo_id}', 'PhotoController@edit')->name('photo_edit');
        Route::post('/photo/update/{photo_id}', 'PhotoController@update')->name('photo_update');
        Route::get('/photo/destroy/{id}', 'PhotoController@destroy')->name('photo_destroy');
        Route::get('/slider', 'SliderController@index')->name('slider');
        Route::get('/slider/create', 'SliderController@create')->name('slider_create');
        Route::get('/post', 'BlogController@index')->name('post');
        Route::get('/post/create', 'BlogController@create')->name('post_create');
        Route::post('/post/store', 'BlogController@store')->name('post_store');
        Route::get('/post/edit/{id}', 'BlogController@edit')->name('post_edit');
        Route::get('/post/destroy/{id}', 'BlogController@destroy')->name('post_destroy');
        Route::post('/post/update/{id}', 'BlogController@update')->name('post_update');

        Route::get('/page', 'PageController@index')->name('page');
        Route::get('/page/create', 'PageController@create')->name('page_create');
        Route::post('/page/store', 'PageController@store')->name('page_store');
        Route::get('/page/edit/{id}', 'PageController@edit')->name('page_edit');
//Route::get('/page/destroy/{id}', 'PageController@destroy')->name('page_destroy');
        Route::post('/page/update/{id}', 'PageController@update')->name('page_update');
    });

Auth::routes();

Route::get('sitemap', function() {

    // create new sitemap object
    $sitemap = App::make('sitemap');

    // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
    // by default cache is disabled
//    $sitemap->setCache('laravel.sitemap', 60);

    // check if there is cached sitemap and build new only if is not
    if (!$sitemap->isCached()) {
        // add item to the sitemap (url, date, priority, freq)
        $sitemap->add(URL::to('/'), date('Y-m-dTH:i:sP', time()), '1.0', 'daily');
        $sitemap->add(URL::to('/galleries'), date('Y-m-dTH:i:sP', time()), '0.9', 'daily');
        $sitemap->add(URL::to('/posts'), date('Y-m-dTH:i:sP', time()), '0.9', 'daily');
        $galleries = \App\DB_Models\Gallery::orderBy('date_create', 'desc')->get();
        foreach ($galleries as $gallery) {
            // get all images for the current post
            $images = [];
            foreach ($gallery->photos as $image) {
                $images[] = [
                    'url' => URL::to(Storage::disk('photos')->url($image->path)),
                    'title' => $image->description,
//                    'caption' => $image->description
                ];
            }
            $sitemap->add(URL::to('/gallery/' . $gallery->slug), $gallery->date_create, 0.8, 'daily', $images);
        }
        $posts = \App\DB_Models\Post::orderBy('date_create', 'desc')->get();
        foreach ($posts as $post) {
            $sitemap->add(URL::to('/post/' . $post->slug), $post->date_create, 0.8, 'daily');
        }
    }

    // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
    return $sitemap->render('xml');
});
