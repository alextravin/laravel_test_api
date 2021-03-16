<?php

namespace App\Services\Book;

use App\Models\Book;
use App\Services\Author\AuthorService;
use App\Services\Book\DTO\CreateBookDTO;
use App\Services\Book\DTO\DTOInterface;
use App\Services\Book\DTO\UpdateBookDTO;
use App\Services\Book\Handlers\CreateBookHandler;
use App\Services\Book\Handlers\UpdateBookHandler;
use App\Services\Book\Repositories\EloquentBookRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class BookService
{
    private EloquentBookRepository $bookRepository;
    private CreateBookHandler $createBookHandler;
    private AuthorService $authorService;
    private UpdateBookHandler $updateBookHandler;

    public function __construct(
        EloquentBookRepository $bookRepository,
        CreateBookHandler $createBookHandler,
        AuthorService $authorService,
        UpdateBookHandler $updateBookHandler
    ) {
        $this->bookRepository = $bookRepository;
        $this->createBookHandler = $createBookHandler;
        $this->authorService = $authorService;
        $this->updateBookHandler = $updateBookHandler;
    }


    public function getAll(int $limit, int $offset): Collection
    {
        return $this->bookRepository->getAll([], $limit, $offset);
    }

    public function find(int $id): ?Book
    {
        return $this->bookRepository->findById($id);
    }

    public function createBookFromArray(array $array): Book
    {
        $dto = CreateBookDTO::fromArray($array);
        $this->getAuthorsForDto($dto);
        return $this->createBookHandler->handle($dto);
    }

    public function updateBook(Book $book, array $array): void
    {
        $dto = UpdateBookDTO::fromArray($array);
        $this->getAuthorsForDto($dto);
        $this->updateBookHandler->handle($book, $dto);
    }


    /**
     * @return DTOInterface
     */
    protected function getAuthorsForDto(DTOInterface $dto)
    {
        $data = $dto->toArray();
        $relations = [];
        foreach (Arr::get($data, 'authors_id', []) as $index => $id) {
            $relationItem = $this->authorService->find($id);
            if ($relationItem !== null) {
                $relations[] = $relationItem;
            }
        }
        $dto->setAuthors($relations);
    }
}
