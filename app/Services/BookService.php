<?php

namespace App\Services;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Exception;

class BookService implements IBookService
{
    private $bookStoreService;

    public function __construct(IBookStoreService $bookStoreService)
    {
        $this->bookStoreService = $bookStoreService;
    }


    public function store(BookRequest $request) {

        try {
            if (isset($request->stores)) {
                $this->bookStoreService->canSaveBook($request->stores);
            }

            $book = new Book();

            $book->create([
                "name" => $request->name,
                "isbn" => $request->isbn,
                "value" => $request->value,
            ]);

            if (isset($request->stores)) {
                $bookid = $book->getLastId();
                foreach($request->stores as $storeid) {
                    $this->bookStoreService->store($bookid, $storeid);
                }
            }

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function all() {
        return Book::all();
    }

    public function get(int $id) {
        return Book::with(["stores"])->where("id", $id)->first();
    }

    public function update(BookRequest $request, int $id) {
        try {
            if (isset($request->stores)) {
                $this->bookStoreService->canSaveBook($request->stores);
            }

            $book = $this->get($id);

            if ($book == null) {
                throw new Exception("Book not exist");
            }

            $book->update(
                array(
                    "name" => $request->name,
                    "isbn" => $request->isbn,
                    "value" => $request->value
                )
            );

            if (isset($request->stores)) {
                $book->with(["stores"]);

                foreach($book->stores as $store) {
                    $this->bookStoreService->delete($store->pivot->id);
                }

                foreach($request->stores as $storeid) {
                    $this->bookStoreService->store($book->id, $storeid);
                }
            }

        } catch(Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function delete(int $id){
        try {

            $book = Book::where("id", $id)->first();

            if ($book == null) {
                throw new Exception("Book not exist");
            }

            $book->delete();

        } catch(Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
