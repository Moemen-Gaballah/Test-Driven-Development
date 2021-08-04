<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Isbn;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required",
            "description" => ["required", "min:20"],
            "author_id" => "exists:authors,id",
            "ISBN" => [new Isbn()]
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "title is required",
            "description.required" => "description is required",
            "description.min" => "description length minimum is 20",
            "author_id.exists" => "Author must be valid",
        ];
    }
}
