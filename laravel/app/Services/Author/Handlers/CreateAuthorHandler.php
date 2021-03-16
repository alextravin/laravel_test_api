<?php

namespace App\Services\Author\Handlers;

use App\Models\Author;
use App\Services\Author\DTO\CreateAuthorDTO;
use App\Services\Author\Repositories\EloquentAuthorRepository;

class CreateAuthorHandler
{
    private EloquentAuthorRepository $repository;

    public function __construct(EloquentAuthorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(CreateAuthorDTO $dto): Author
    {
        return $this->repository->createFromDTO($dto);
    }
}
