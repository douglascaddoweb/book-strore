<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Services\IBookService;
use Exception;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $bookService;

    public function __construct(IBookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function store(BookRequest $request) {
        try {
            $this->bookService->store($request);

            return response()->json(["message" => "Saved successfully"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function all() {
        return $this->bookService->all();
    }

    public function get(int $id) {
        return $this->bookService->get($id);
    }

    public function update(BookRequest $request, int $id) {
        try {
            $this->bookService->update($request, $id);

            return response()->json(["message" => "Updated successfully"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function delete(int $id) {
        try {
            $this->bookService->delete($id);

            return response()->json(["message" => "Deleted successfully"], 200);
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }
}
