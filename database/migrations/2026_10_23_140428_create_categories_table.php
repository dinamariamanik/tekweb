<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Buat tabel categories terlebih dahulu
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id')->autoIncrement();
            $table->string('category', 100);
            $table->timestamps();
        });

        // 2. Buat tabel products setelahnya
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id')->autoIncrement();
            $table->string('name', 150);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->decimal('price', 12, 2);
            $table->string('img')->nullable();
            $table->integer('stock')->default(0);
            $table->string('slug')->unique();
            $table->timestamps();

            // Foreign key aman karena tabel categories sudah dibuat di atasnya
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
};