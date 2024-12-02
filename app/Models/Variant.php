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
    ];

    public function model()
    {
        return $this->belongsTo(Model3D::class, 'model_id');
    }
}
