<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_item';

    protected $with = ['product'];

    public function product()
    {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }
}
