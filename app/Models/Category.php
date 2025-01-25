<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'categoryName',
        'categoryImg'
    ];

    // Ensure column names match exactly
    protected $table = 'categories';

    /**
     * Get the products for the category.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Delete prevention if products exist
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($category) {
            if ($category->products()->count() > 0) {
                throw new \Exception('Cannot delete category with associated products.');
            }
        });
    }
}
