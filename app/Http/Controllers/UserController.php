<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function products()
    {
        $produk = Products::all();

        return response()->json([
            'produk' => $produk
        ], 200);
    }
}
