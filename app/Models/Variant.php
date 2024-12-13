<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $table = 'variants';

    protected $fillable = [
        'model_id',
        'variant_name',
        'variant_index',
        'image_path',
        'price',
    ];

    public function model()
    {
        return $this->belongsTo(Models::class, 'model_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
