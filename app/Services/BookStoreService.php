<?php

namespace App\Services;

use App\Models\Book;
use App\Models\BookStore;
use App\Models\Store;
use Exception;

class BookStoreService implements IBookStoreService
{

    public function canSaveStore(array $stores) {

        $storeTotal = Store::whereIn('id', $stores)->count();

        if ($storeTotal < count($stores)) {
            throw new Exception("Some store doesn't exist");
        }
    }

    public function canSaveBook(array $books) {

        $bookTotal = Book::whereIn('id', $books)->count();

        if ($bookTotal < count($books)) {
            throw new Exception("Some book doesn't exist");
        }
    }

    public function store(int $bookid, int $storeid) {


        $bookStore = new BookStore();

        $bookStore->create(
            array(
                "bookid" => $bookid,
                "storeid" => $storeid
            )
        );
    }

    public function delete(int $id) {
        $bookStore = BookStore::where("id", $id)->first();

        if ($bookStore == null) {
            return;
        }

        $bookStore->delete();
    }
}
