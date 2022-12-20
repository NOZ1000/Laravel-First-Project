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

    public function getForiegnKey()
    {
        $parent = get_parent_class($this);

        return (new $parent)->getForeignKey();
    }

    public function getMorphClass()
    {
        $parent = get_parent_class($this);

        return (new $parent)->getMorphClass();
    }
}
