<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\DispatchQueueItem;

class DispatchQueueItemRepository implements DispatchQueueItemRepositoryInterface
{
    public function getPaginated(int $page, int $perPage, string $sortBy = 'created_at', string $sortOrder = 'desc'): LengthAwarePaginator
    {
        $query = DispatchQueueItem::orderBy($sortBy, $sortOrder);
        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    public function findById(string $id): ?DispatchQueueItem
    {
        return DispatchQueueItem::find($id);
    }

    public function create(array $data): DispatchQueueItem
    {
        return DispatchQueueItem::create($data);
    }

    public function update(string $id, array $data): ?DispatchQueueItem
    {
        $item = DispatchQueueItem::find($id);
        if (!$item) {
            return null;
        }
        $item->fill($data);
        $item->save();
        return $item;
    }

    public function delete(string $id): bool
    {
        $item = DispatchQueueItem::find($id);
        if (!$item) {
            return false;
        }
        return (bool) $item->delete();
    }
}
