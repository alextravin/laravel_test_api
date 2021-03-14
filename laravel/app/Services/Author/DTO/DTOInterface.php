<?php


namespace App\Services\Author\DTO;


interface DTOInterface
{
    public static function fromArray(array $data): self;
    public function toArray(): array;
}
