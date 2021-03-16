<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class ApiBookStoreRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title' => ['required','string'],
            'authors_id' => ['array']
        ];
    }
}
