<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Store;
use App\Services\IStoreService;
use Exception;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private $storeService;

    public function __construct(IStoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    public function store(StoreRequest $request) {
        try {
            $this->storeService->store($request);

            return response()->json(["message" => "Saved successfully"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function all() {
        return $this->storeService->all();
    }

    public function get(int $id) {
        return $this->storeService->get($id);
    }

    public function update(StoreRequest $request, $id) {
        try {
            $this->storeService->update($request, $id);

            return response()->json(["message" => "updated successfully"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function delete($id) {
        try {
            $this->storeService->delete($id);

            return response()->json(["message" => "Deleted successfully"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }
}
