<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_des',
        'long_des',
        'price',
        'discount_price',
        'discount',
        'image',
        'stock',
        'star',
        'remark',
        'category_id',
        'brand_id'
    ];

    protected $casts = [
        'discount' => 'boolean',
        'stock' => 'boolean',
        'star' => 'float',
        'price' => 'decimal:2'
    ];

    protected $attributes = [
        'star' => 0.0,
        'discount' => false,
        'stock' => true
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function productDetails()
    {
        return $this->hasOne(ProductDetail::class);
    }

    public function productSlider()
    {
        return $this->hasOne(ProductSlider::class);
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function productWishes()
    {
        return $this->hasMany(ProductWish::class);
    }

    public function productCards()
    {
        return $this->hasMany(ProductCard::class);
    }
}
