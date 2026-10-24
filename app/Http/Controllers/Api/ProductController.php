<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan semua data produk beserta kategorinya
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json([
            'success' => true,
            'message' => 'List Data Products',
            'data'    => $products
        ], 200);
    }

    // Menyimpan data produk baru dari admin
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:150',
            'category_id' => 'required|exists:categories,category_id',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'slug'        => 'required|string|unique:products,slug',
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Product Successfully Created',
            'data'    => $product
        ], 201);
    }
}