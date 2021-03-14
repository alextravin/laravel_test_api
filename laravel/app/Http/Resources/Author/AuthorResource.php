<?php


namespace App\Http\Resources\Author;

use App\Http\Resources\BaseResource;
use App\Http\Resources\Book\BookRelationResource;

class AuthorResource extends BaseResource
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
            'type'          => 'authors',
            'id'            => (string) $this->id,
            'name' => $this->name,
        ];
    }
}
