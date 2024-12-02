<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Model3D extends Model
{
    use HasFactory;

    protected $table = 'models';

    protected $fillable = [
        'model_name',
        'uri',
    ];

    public function variants()
    {
        return $this->hasMany(Variant::class, 'model_id');
    }
}
