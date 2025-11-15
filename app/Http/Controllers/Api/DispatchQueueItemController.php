<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DispatchQueueItem;
use Illuminate\Http\Request;

class DispatchQueueItemController extends Controller
{
    public function index()
    {
        $items = DispatchQueueItem::paginate(50);
        return response()->json($items);
    }

    public function store(Request $request)
    {
        // Implementation for creating
    }

    public function show($id)
    {
        $item = DispatchQueueItem::findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        // Implementation for updating
    }

    public function destroy($id)
    {
        // Implementation for deleting
    }
}
