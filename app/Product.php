<?php

namespace App;
use App\Cart;
use App\Order;
use App\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'status'
    ];

    public function carts() {
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }

    public function orders() {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function images() 
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
