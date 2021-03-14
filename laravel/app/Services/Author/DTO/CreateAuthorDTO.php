<?php


namespace App\Services\Author\DTO;


class CreateAuthorDTO implements DTOInterface
{
    private string $name;


    public function __construct(
        string $name
    )
    {
        $this->name = $name;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }

}
