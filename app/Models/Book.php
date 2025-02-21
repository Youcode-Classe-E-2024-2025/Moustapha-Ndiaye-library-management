<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Book extends Model
{
    use HasFactory; 

    protected $fillable = ['title', 'imgURL', 'isAvailable', 'borrowsBY', 'user_id', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}



