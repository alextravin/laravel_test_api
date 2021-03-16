<?php

namespace App\Services\Author;

use App\Models\Author;
use App\Services\Author\DTO\CreateAuthorDTO;
use App\Services\Author\Handlers\CreateAuthorHandler;
use App\Services\Author\Repositories\EloquentAuthorRepository;
use Illuminate\Database\Eloquent\Collection;

class AuthorService
{
    private EloquentAuthorRepository $authorRepository;
    private CreateAuthorHandler $createAuthorHandler;

    public function __construct(
        EloquentAuthorRepository $authorRepository,
        CreateAuthorHandler $createAuthorHandler
    ) {
        $this->authorRepository = $authorRepository;
        $this->createAuthorHandler = $createAuthorHandler;
    }


    public function getAll(int $limit, int $offset): Collection
    {
        return $this->authorRepository->getAll([], $limit, $offset);
    }

    public function find(int $id): ?Author
    {
        return $this->authorRepository->findById($id);
    }


    public function createAuthorFromArray(array $array): Author
    {
        $dto = CreateAuthorDTO::fromArray($array);
        return $this->createAuthorHandler->handle($dto);
    }
}
