<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\DispatchQueueItem;

interface DispatchQueueItemServiceInterface
{
    public function getPaginatedItems(int $page, int $perPage, string $sortBy = 'created_at', string $sortOrder = 'desc'): LengthAwarePaginator;
    public function getItemById(string $id): ?DispatchQueueItem;
    public function createItem(array $data): DispatchQueueItem;
    public function updateItem(string $id, array $data): ?DispatchQueueItem;
    public function deleteItem(string $id): bool;
}
