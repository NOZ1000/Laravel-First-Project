<?php

namespace App;
use App\Cart;
use App\Order;
use App\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\AvailableScope;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $with = [
        'images'
    ];

    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'status'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new AvailableScope);
    }

    public function carts() {
        return $this->morphedByMany(Cart::class, 'productable')->withPivot('quantity');
    }

    public function orders() {
        return $this->morphedByMany(Order::class, 'productable')->withPivot('quantity');
    }

    public function images() 
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function getTotalAttribute()
    {
        return $this->price * $this->pivot->quantity;
    }
}
