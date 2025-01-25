<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'brandName',
        'brandImg'
    ];

    /**
     * Get the products for the brand.
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

        static::deleting(function($brand) {
            if ($brand->products()->count() > 0) {
                throw new \Exception('Cannot delete brand with associated products.');
            }
        });
    }
}
