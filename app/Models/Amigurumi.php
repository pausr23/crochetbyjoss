<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amigurumi extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image', 'category_id'];
    
    // Relación con la categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

