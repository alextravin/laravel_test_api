<?php


namespace App\Http\Requests\Author;


use App\Http\Requests\ApiIndexRequest;

class ApiAuthorStoreRequest extends ApiIndexRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required','string'],
        ];
    }
}
