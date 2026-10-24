<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';
    
    protected $fillable = [
        'name', 
        'description', 
        'category_id', 
        'price', 
        'stock', 
        'slug', 
        'img'
    ];

    // Relasi balik: Produk ini milik satu Kategori (BelongsTo)
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}