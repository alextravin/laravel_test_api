<?php


namespace App\Services\Book\Repositories;

use App\Models\Book;
use App\Services\Book\DTO\DTOInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class EloquentBookRepository implements BookRepositoryInterface
{
    const DEFAULT_LIMIT = 10;

    public function getAll(array $filters, ?int $limit = null, int $offset = 0): Collection
    {
        $query = Book::query();
        $this->applyFilters($query, $filters);
        $query->take($limit ?? static::DEFAULT_LIMIT);
        $query->offset($offset);
        return $query->get();
    }

    protected function applyFilters($query, array $filters): void
    {
        //@todo Implement the method
    }

    public function findById(int $id): ?Book
    {
        return Book::findOrFail($id);
    }

    public function createFromDTO(DTOInterface $dto): Book
    {
        return Book::create($dto->toArray());
    }

    public function updateFromDTO(Book $book, DTOInterface $dto): Book
    {
        $book->update($dto->toArray());
        return $book;
    }

    public function saveAuthors(Book $item, DTOInterface $dto): self
    {
        $data = $dto->toArray();
        $item->authors()->detach();
        $item->authors()->saveMany(Arr::get($data, 'authors', []));
        return $this;
    }

}
