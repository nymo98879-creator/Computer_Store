<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = "products";
    protected $fillable = ['name', 'description', 'price', 'stock', 'image', 'category_id'];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class); // ✅ correct
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
