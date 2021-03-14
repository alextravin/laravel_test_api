<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class BaseResource extends JsonResource
{
    public function filterResult(array $result, Request $request): array
    {
        $fieldsRequest = $request->get('fields', null);
        if ($fieldsRequest) {
            $fields = explode(',', str_replace(' ', '', $fieldsRequest));
            $result = Arr::only($result, $fields);
        }

        return $result;
    }
}
