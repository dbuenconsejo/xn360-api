<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DispatchQueueItemService; // changed to concrete service
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DispatchQueueItemController extends Controller
{
    public function __construct(
        private DispatchQueueItemService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        try {
            $page = (int) $request->query('page', 1);
            $perPage = (int) $request->query('per_page', 10);

            if ($page < 1 || $perPage < 1) {
                return response()->json(
                    ['error' => 'page and per_page must be positive integers'],
                    400
                );
            }

            $result = $this->service->getPaginatedItems($page, $perPage);

            return response()->json($result->toArray(), 200);
        } catch (\Exception $e) {
            return response()->json(
                ['error' => 'Failed to fetch dispatch queue items'],
                500
            );
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $item = $this->service->getItemById($id);

            if (!$item) {
                return response()->json(['error' => 'Item not found'], 404);
            }

            return response()->json($item, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch item'], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $item = $this->service->createItem($request->validated());
            return response()->json($item, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create item'], 500);
        }
    }

    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $item = $this->service->updateItem($id, $request->validated());
            return response()->json($item, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update item'], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $success = $this->service->deleteItem($id);

            if (!$success) {
                return response()->json(['error' => 'Item not found'], 404);
            }

            return response()->noContent();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete item'], 500);
        }
    }
}
