<?php

namespace App\Services;

use App\Repositories\DispatchQueueItemRepositoryInterface;
use App\Models\DispatchQueueItem;
use Illuminate\Pagination\LengthAwarePaginator;

class DispatchQueueItemService implements DispatchQueueItemServiceInterface
{
    public function __construct(
        private DispatchQueueItemRepositoryInterface $repository
    ) {}

    public function getPaginatedItems(int $page, int $perPage, string $sortBy = 'created_at', string $sortOrder = 'desc'): LengthAwarePaginator
    {
        return $this->repository->getPaginated($page, $perPage, $sortBy, $sortOrder);
    }

    public function getItemById(string $id): ?DispatchQueueItem
    {
        return $this->repository->findById($id);
    }

    public function createItem(array $data): DispatchQueueItem
    {
        return $this->repository->create($data);
    }

    public function updateItem(string $id, array $data): ?DispatchQueueItem
    {
        return $this->repository->update($id, $data);
    }

    public function deleteItem(string $id): bool
    {
        return $this->repository->delete($id);
    }
}
