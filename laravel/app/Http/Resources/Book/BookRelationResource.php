<?php


namespace App\Http\Resources\Book;

use App\Http\Resources\BaseResource;

class BookRelationResource extends BaseResource
{

    public function toArray($request)
    {
        return [
            'id'            => (string) $this->id,
            'title' => $this->title,
        ];
    }
}
