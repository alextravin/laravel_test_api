<?php


namespace App\Services\Book\Handlers;


use App\Models\Book;
use App\Services\Book\DTO\UpdateBookDTO;
use App\Services\Book\Repositories\EloquentBookRepository;

class UpdateBookHandler
{
    private EloquentBookRepository $repository;

    public function __construct(EloquentBookRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(Book $item, UpdateBookDTO $dto): Book
    {
        $item = $this->repository->updateFromDTO($item, $dto);
        $this->repository->saveAuthors($item, $dto);
        return $item;
    }

}
