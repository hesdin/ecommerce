<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Products;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function products()
    {
        $produk = Products::all()->shuffle();

        return response()->json([
            'produk' => $produk
        ], 200);
    }

    public function addToCart(Request $req)
    {
        $cart = Cart::find($req->user()->id);
        $ci = new CartItem();
        if (!$cart) {
            $c = new Cart();
            $c->customer_id = $req->user()->id;
            $c->save();

            $ci->cart_id = $c->customer_id;
        } else {
            $ci->cart_id = $cart->id;
        }
        $ci->product_id = $req->product_id;
        $ci->qty = $req->qty;
        $ci->save();

        return response()->json([
            'message' => 'berhasil'
        ], 200);
    }
}
