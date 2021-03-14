<?php


namespace App\Http\Resources\Author;

use App\Http\Resources\BaseResource;

class AuthorRelationResource extends BaseResource
{

    public function toArray($request)
    {
        return [
            'id' => (string) $this->id,
            'name' => $this->name,
        ];
    }
}
