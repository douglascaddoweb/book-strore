<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookstore', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("bookid");
            $table->unsignedBigInteger("storeid");
            $table->timestamps();

            $table->foreign('bookid')->references('id')->on('book');
            $table->foreign('storeid')->references('id')->on('store');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookstore');
    }
};
