<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\DispatchQueueItem;

interface DispatchQueueItemRepositoryInterface
{
    public function getPaginated(int $page, int $perPage, string $sortBy = 'created_at', string $sortOrder = 'desc'): LengthAwarePaginator;
    public function findById(string $id): ?DispatchQueueItem;
    public function create(array $data): DispatchQueueItem;
    public function update(string $id, array $data): ?DispatchQueueItem;
    public function delete(string $id): bool;
}
