<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'limit' => 'nullable|integer|min:0|max:50',
            'offset' => 'nullable|integer|min:0',
        ];
    }
}
