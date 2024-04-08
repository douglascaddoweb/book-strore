<?php

namespace App\Services;

interface IBookStoreService
{
    public function store(int $bookid, int $storeid);
    public function delete(int $id);
    public function canSaveStore(array $stores);
    public function canSaveBook(array $books);
}
