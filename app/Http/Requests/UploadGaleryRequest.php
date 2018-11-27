<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadGaleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $photos = count($this->request) - 1;
        foreach(range(0, $photos) as $index) {
            $rules[$index] = 'image|mimes:jpeg,png|max:2000';
        }
        return $rules;
    }
}
