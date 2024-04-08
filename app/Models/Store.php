<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Store extends Model
{
    use HasFactory;

    protected $table = "store";

    protected $fillable = [
        "name", "address", "active"
    ];

    public function getLastId() {
        return DB::getPdo()->lastInsertId();
    }

    public function books(): BelongsToMany {
        return $this->belongsToMany(Book::class, BookStore::class, "storeid", "bookid")->withPivot('id', 'storeid', 'bookid');
    }
}
