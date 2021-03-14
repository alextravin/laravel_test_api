<?php


namespace App\Services\Author\Repositories;


use Illuminate\Database\Eloquent\Collection;

interface AuthorRepositoryInterface
{
    public function getAll(array $filters, ?int $limit = null, int $offset = 0): Collection;
}
