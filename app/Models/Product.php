<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $appends = ['low_stock'];

    protected $wishlist = ['wishlist'];

    protected $carts = ['carts'];

    protected $fillable = [
        'name', 'detail', 'price', 'stock', 'weight', 'images', 'category_id', 'sub_category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class);
    }

    public function getDiscountedPriceAttribute()
    {
        $discountedPrice = $this->price;

        foreach ($this->coupons as $coupon) {
            if ($coupon->status && now()->between($coupon->starts_at, $coupon->expires_at)) {
                $discountedPrice *= ((100 - $coupon->discount_amount) / 100);
            }
        }

        return $discountedPrice;
    }

    public function isNearlyOutOfStock()
    {
        return $this->stock <= 3;
    }

    public function getLowStockAttribute()
    {
        return $this->isNearlyOutOfStock();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function carts()
    {
        return $this->belongsToMany(Carts::class, 'cart_product')->withPivot('quantity');
    }

    public function wishlists()
    {
        return $this->belongsTo(Wishlist::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function approvedRatings()
    {
        return $this->ratings()->where('approved', true);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    public function relatedProducts()
    {
        return $this->belongsToMany(Product::class, 'related_products', 'product_id', 'related_product_id');
    }

    public function isFavorited()
    {
        return auth()->user() && auth()->user()->wishlist()->where('product_id', $this->id)->exists();
    }

    public function isCarts()
    {
        return auth()->user() && auth()->user()->carts()->where('product_id', $this->id)->exists();
    }
}