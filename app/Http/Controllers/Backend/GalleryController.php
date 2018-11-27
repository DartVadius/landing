<?php

namespace App\Http\Controllers\Backend;

use App\Classes\Socket\PusherMessage;
use App\DB_Models\Gallery;
use App\DB_Models\Photo;
use App\Events\GalleryPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadGaleryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class GalleryController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $galleries = Gallery::all();
        return view('backend.gallery', ['galleries' => $galleries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $gallery = new Gallery();
        return view('backend.gallery_create', ['gallery' => $gallery]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:galleries|max:255',
            'description' => 'max:255',
        ]);
        $data = $request->all();
        unset($data['_token']);
        $gallery = Gallery::setup($data);
//        event(new GalleryPost($gallery));
        $gallery->save();
        return redirect()->action(
            'Backend\GalleryController@edit', ['id' => $gallery->id]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return view('backend.gallery');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $gallery = Gallery::find($id);
        $photos = $gallery->photos()->get()->toArray();
        $photos = Photo::getThumbs($photos);
        return view('backend.gallery_update', ['gallery' => $gallery, 'photos' => $photos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'max:255'
        ]);
        $data = $request->all();
        unset($data['_token']);
        $gallery = Gallery::setup($data, $id);
        event(new GalleryPost($gallery));
        $gallery->save();
        return redirect()->action(
            'Backend\GalleryController@edit', ['id' => $gallery->id]
        );
    }

    /**
     * @param UploadGaleryRequest $request
     * @param                     $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function add_photos(UploadGaleryRequest $request, $id) {
        $photos = Photo::uploadPhotos($request, $id);
        $data = [
            'topic_id' => 'newGallery',
            'data' => "Галерея {$id} была обновлена",
        ];
        PusherMessage::sendDataToServer($data);
        return response()->json([
            'photos' => $photos
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Storage::disk('photos')->deleteDirectory($id);
        Gallery::where('id', $id)->delete();
        Photo::where('gallery_id', $id)->delete();
        return redirect()->action(
            'Backend\GalleryController@index'
        );
    }
}
