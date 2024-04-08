<?php

namespace App\Services;

use App\Http\Requests\BookRequest;

interface IBookService
{
    public function store(BookRequest $request);
    public function all();
    public function get(int $id);
    public function update(BookRequest $request, int $id);
    public function delete(int $id);
}
