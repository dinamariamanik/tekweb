<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan daftar produk dengan fitur Search, Filter, dan Pagination
    public function index(Request $request)
    {
        $title = "Daftar Inventaris Produk";

        $products = new Product();

        // Fitur Pencarian berdasarkan nama produk
        if ($request->has('s') && $request->s != '') {
            $s = $request->s;
            $products = $products->where('name', 'like', "%$s%");
        }

        // Fitur Filter berdasarkan Kategori
        if ($request->has('category_id') && $request->category_id != '') {
            $products = $products->where('category_id', $request->category_id);
        }

        // Eksekusi query dengan pagination (misal 5 data per halaman)
        $products = $products->with('category')->paginate(5);
        $categories = Category::all();

        return view('admin.products.index', compact('title', 'products', 'categories'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        $title = "Tambah Produk Baru";
        $categories = Category::all();
        return view('admin.products.create', compact('title', 'categories'));
    }

    // Menyimpan data produk baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,category_id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'slug' => 'required|string|unique:products,slug',
            'img' => 'nullable|string'
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Menampilkan form edit produk
    public function edit($id)
    {
        $title = "Edit Produk";
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('title', 'product', 'categories'));
    }

    // Memperbarui data produk di database
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,category_id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'slug' => 'required|string|unique:products,slug,' . $id . ',product_id',
            'img' => 'nullable|string'
        ]);

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    // Menghapus data produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}