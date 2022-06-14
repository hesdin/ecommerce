<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $with = ['item'];

    protected $appends = ['tanggal'];

    public function getTanggalAttribute()
    {
        return Carbon::parse($this->created_at)->isoFormat('D MMMM YYYY');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }

    public function item()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
