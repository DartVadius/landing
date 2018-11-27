<?php

namespace App\DB_Models;

use App\Http\Requests\UploadGaleryRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as ImageInt;

class Photo extends Model {
    protected $table = 'photos';
    protected $fillable = ['path', 'mobile', 'description', 'gallery_id'];
    public $timestamps = false;

    public function gallery() {
        return $this->belongsTo('App\DB_Models\Gallery');
    }

    public static function uploadPhotos(UploadGaleryRequest $request, $id) {
        $photos = [];
        foreach ($request->allFiles() as $photo) {

            $path = $photo->store('public/photos/' . $id);
            $image = ImageInt::make(Storage::get($path));

            $path_arr = explode('/', $path);
            $name = end($path_arr);

            $image->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode();
            Storage::disk('photos')->put($id . '/900_' . $name, $image);

            $image->crop(450, 450)->encode();
            Storage::disk('photos')->put($id . '/thumb_' . $name, $image);
            $photos[] = $id . '/thumb_' . $name;
            self::create([
                'path' => 'photos/' . $id . '/900_' . $name,
                'gallery_id' => $id,
            ]);
        }
        return $photos;
    }
    public static function getThumbs(array $photos) {
        $result = [];
        foreach ($photos as $photo) {
            $photo['path'] = str_replace('900_', 'thumb_', $photo['path']);
            $result[] = $photo;
        }
        return $result;
    }

    public static function deletePhoto($path) {
        $path = str_replace('photos/', '', $path);
        Storage::disk('photos')->delete($path);
        $thumb = str_replace('900_', 'thumb_', $path);
        Storage::disk('photos')->delete($thumb);
        $origin = str_replace('900_', '', $path);
        Storage::disk('photos')->delete($origin);
        return true;
    }
}
