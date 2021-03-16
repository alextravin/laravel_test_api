<?php

namespace App\Http\Requests\Author;

use App\Http\Requests\ApiIndexRequest;

class ApiAuthorBooksRequest extends ApiIndexRequest
{
    public function rules(): array
    {
        return [
            'limit' => 'nullable|integer|min:0|max:50',
            'offset' => 'nullable|integer|min:0',
        ];
    }
}
