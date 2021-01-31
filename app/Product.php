<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 
        'description', 
        'price',
        'image',
        'created_at',
        'updated_at'
    ];
}
