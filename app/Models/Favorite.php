<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function item()
    {
        return $this->hasMany(Products::class, 'id', 'product_id');
    }
}
