<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateMovieRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'nullable|min:2|max:255,',
            'summary' => 'nullable|string',
            'release_date' => 'nullable|date',
            'director' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'main_image' => 'nullable|image',
            "video" => 'nullable|file|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime',
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
