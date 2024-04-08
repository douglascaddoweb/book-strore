<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    use HasFactory;

    protected $table = "book";

    protected $fillable = [
        "name", "isbn", "value"
    ];

    public function getLastId() {
        return DB::getPdo()->lastInsertId();
    }

    public function stores(): BelongsToMany {
        return $this->belongsToMany(Store::class, 'bookstore', "bookid", "storeid")->withPivot('id', 'storeid', 'bookid');
    }
}
