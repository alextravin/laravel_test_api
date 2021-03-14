<?php


namespace App\Http\Resources\Book;


use App\Http\Resources\BaseResource;

class BookResource extends BaseResource
{

    public function toArray($request)
    {
        return [
            'id'            => (string) $this->id,
            'name' => $this->title,
        ];
    }
}
