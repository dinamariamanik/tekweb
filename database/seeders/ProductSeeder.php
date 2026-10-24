<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Membuat kategori contoh
        $cat1 = Category::create(['category' => 'Elektronik']);
        $cat2 = Category::create(['category' => 'Aksesoris']);

        // Membuat produk contoh untuk TekWeb Store
        Product::create([
            'name' => 'Laptop Gaming Pro',
            'description' => 'Laptop gaming dengan performa tinggi untuk kebutuhan komputasi dan gaming.',
            'category_id' => $cat1->category_id,
            'price' => 15000000,
            'stock' => 10,
            'slug' => 'laptop-gaming-pro',
            'img' => 'https://via.placeholder.com/150'
        ]);

        Product::create([
            'name' => 'Mechanical Keyboard RGB',
            'description' => 'Keyboard mekanik dengan lampu latar RGB dan switch yang nyaman.',
            'category_id' => $cat2->category_id,
            'price' => 750000,
            'stock' => 25,
            'slug' => 'mechanical-keyboard-rgb',
            'img' => 'https://via.placeholder.com/150'
        ]);
    }
}