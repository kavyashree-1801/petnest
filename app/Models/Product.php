<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [

        'name',

        'description',

        'price',

        'image',

        'category_id'

    ];


    // CATEGORY
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    // WISHLIST
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}