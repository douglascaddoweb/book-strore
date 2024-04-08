<?php

namespace App\Services;

use App\Http\Requests\StoreRequest;

interface IStoreService
{
    public function store(StoreRequest $request);
    public function all();
    public function get(int $id);
    public function update(StoreRequest $request, $id);
    public function delete($id);
}
