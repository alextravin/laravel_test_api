<?php

namespace App\Services\Book\DTO;

class UpdateBookDTO implements DTOInterface
{
    private string $title;
    private array $authors_id;

    /**
     * @var \App\Models\Author[]
     */
    private array $authors;


    public function __construct(
        string $title,
        array $authors_id,
        array $authors
    ) {
        $this->title = $title;
        $this->authors_id = $authors_id;
        $this->authors = $authors;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['title'],
            $data['authors_id'] ?? [],
            $data['authors'] ?? []
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'authors_id' => $this->authors_id,
            'authors' => $this->authors,
        ];
    }

    public function setAuthors(array $authors): void
    {
        $this->authors = $authors;
    }
}
