<?php

namespace App\Services\Book\Handlers;

use App\Models\Book;
use App\Services\Book\DTO\CreateBookDTO;
use App\Services\Book\Repositories\EloquentBookRepository;

class CreateBookHandler
{
    private EloquentBookRepository $repository;

    public function __construct(EloquentBookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(CreateBookDTO $dto): Book
    {
        $item = $this->repository->createFromDTO($dto);
        $this->repository->saveAuthors($item, $dto);
        return $item;
    }
}
