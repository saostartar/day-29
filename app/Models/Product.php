<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Define the fillable attributes
    protected $fillable = [
        'name',
        'price',
        'stock',
    ];

    // Optionally, you can define relationships, accessors, mutators, etc.
}