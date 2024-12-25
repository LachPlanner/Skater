<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'variant_id',
        'price',
    ];

    // Relation til Variant
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    // Relation til CartItems
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Relation til OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
