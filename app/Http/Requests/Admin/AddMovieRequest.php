<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddMovieRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "title" => 'required|min:2|max:100',
            "summary" => 'required',
            "release_date" => 'required',
            "director" => 'required',
            "video" => 'nullable|file|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime',
            "category_id" => "required",
            "main_image"=>"required"
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation failed..!',
            'errors' => $validator->errors()->all(),
        ], 422));
    }
}
