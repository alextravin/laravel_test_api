<?php


namespace App\Services\Book\Repositories;


use App\Models\Book;
use App\Services\Book\DTO\DTOInterface;
use Illuminate\Database\Eloquent\Collection;

interface BookRepositoryInterface
{
    public function getAll(array $filters, ?int $limit = null, int $offset = 0): Collection;

    public function findById(int $id): ?Book;

    public function createFromDTO(DTOInterface $dto): Book;

}
