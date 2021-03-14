<?php


namespace App\Http\Resources\Book;

use App\Http\Resources\Author\AuthorRelationResource;
use App\Http\Resources\BaseResource;

class BookFullResource extends BaseResource
{
    /**
     * Преобразование ресурса в массив.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type'          => 'books',
            'id'            => (string) $this->id,
            'title' => $this->title,
            'authors' => AuthorRelationResource::collection($this->authors),
        ];
    }
}
