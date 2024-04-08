<?php

namespace App\Services;

use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Exception;

class StoreService implements IStoreService
{
    private $bookStoreService;

    public function __construct(IBookStoreService $bookStoreService)
    {
        $this->bookStoreService = $bookStoreService;
    }

    public function store(StoreRequest $request) {
        try {
            if (isset($request->books)) {
                $this->bookStoreService->canSaveStore($request->books);
            }

            $store = new Store();

            $store->create(
                array(
                    "name" => $request->name,
                    "address" => $request->address,
                    "active" => $request->active
                )
            );

            if (isset($request->books)) {
                $storeid = $store->getLastId();
                foreach($request->books as $bookid) {
                    $this->bookStoreService->store($bookid, $storeid);
                }
            }

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function all() {
        return Store::all();
    }

    public function get(int $id) {
        return Store::with(["books"])->where("id", $id)->first();
    }

    public function update(StoreRequest $request, $id) {
        try {
            if (isset($request->books)) {
                $this->bookStoreService->canSaveStore($request->books);
            }

            $store = $this->get($id);

            if ($store == null) {
                throw new Exception("Store not exist.");
            }
            $store->update(
                array(
                    "name" => $request->name,
                    "address" => $request->address,
                    "active" => $request->active
                )
            );

            if (isset($request->books)) {
                $store->with(["books"]);

                foreach($store->books as $book) {
                    $this->bookStoreService->delete($book->pivot->id);
                }

                foreach($request->books as $bookid) {
                    $this->bookStoreService->store($bookid, $store->id);
                }
            }

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($id) {
        try {
            $store = $this->get($id);

            if ($store == null) {
                throw new Exception("Store not exist.");
            }

            $store->delete();

        } catch (Exception $e) {
            throw $e;
        }
    }
}
