<?php


namespace App\Services\Author\Repositories;


use App\Models\Author;
use App\Services\Author\DTO\DTOInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentAuthorRepository implements AuthorRepositoryInterface
{
    const DEFAULT_LIMIT = 10;

    public function getAll(array $filters, ?int $limit = null, int $offset = 0): Collection
    {
        $query = Author::query();
        $this->applyFilters($query, $filters);
        $query->take($limit ?? static::DEFAULT_LIMIT);
        $query->offset($offset);
        return $query->get();
    }

    protected function applyFilters($query, array $filters): void
    {
        //@todo Implement the method
    }

    public function findById(int $id): ?Author
    {
        return Author::whereId($id)->first();
    }

    public function createFromDTO(DTOInterface $dto): Author
    {
        $data = $dto->toArray();
        return Author::create($data);
    }

}
