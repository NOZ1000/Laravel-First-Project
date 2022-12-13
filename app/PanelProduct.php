<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Product;

class PanelProduct extends Product
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

    protected static function booted()
    {
        // static::addGlobalScope(new AvailableScope);
    }

}
