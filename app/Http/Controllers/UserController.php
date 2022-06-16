<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function products(Request $req)
    {
        if ($req->has('search')) {
            $produk = Products::where('nama_produk', 'LIKE', '%'.$req->search.'%')->get()->shuffle();
        } else {
            $produk = Products::all()->shuffle();
        }

        return response()->json([
            'produk' => $produk
        ], 200);
    }

    public function cart(Request $req)
    {
        $keranjang = Cart::where('customer_id', $req->user()->id)->first();

        return response()->json([
            'items' => $keranjang->item
        ]);
    }

    public function countCart(Request $req)
    {
        $count = Cart::where('customer_id', $req->user()->id)->first()->item()->count();

        return response()->json([
            'message' => 'berhasil',
            'count' => $count
        ], 200);
    }

    public function addToCart(Request $req)
    {
        $cart = Cart::where('customer_id', $req->user()->id)->first();

        if (Product::find($req->product_id)->stok > 0) {
            $ci = new CartItem();
            if (!$cart) {
                $c = new Cart();
                $c->customer_id = $req->user()->id;
                $c->save();

                $ci->cart_id = $c->id;
                $ci->product_id = $req->product_id;
                $ci->qty = 1;
                $ci->save();
            } else {
                $check = CartItem::where('product_id', $req->product_id)->where('cart_id', $cart->id)->first();
                if ($check) {
                    $check->qty = $check->qty + 1;
                    $check->save();
                } else {
                    $ci->cart_id = $cart->id;
                    $ci->product_id = $req->product_id;
                    $ci->qty = 1;
                    $ci->save();
                }
            }
        }


        $count = Cart::where('customer_id', $req->user()->id)->first()->item()->count();

        return response()->json([
            'message' => 'berhasil',
            'count' => $count
        ], 200);
    }

    public function increaseQty(Request $req)
    {
        $item = CartItem::find($req->id);
        $item->qty = $item->qty + 1;
        $item->save();

        $keranjang = Cart::where('customer_id', $req->user()->id)->first();

        return response()->json([
            'message' => 'berhasil',
            'items' => $keranjang->item
        ], 200);
    }

    public function decreaseQty(Request $req)
    {
        $item = CartItem::find($req->id);
        if ($item->qty == 1) {
            $item->delete();
        } else {
            $item->qty = $item->qty - 1;
            $item->save();
        }

        $count = Cart::where('customer_id', $req->user()->id)->first()->item()->count();

        $keranjang = Cart::where('customer_id', $req->user()->id)->first();

        return response()->json([
            'message' => 'berhasil',
            'items' => $keranjang->item,
            'count' => $count
        ], 200);
    }

    public function deleteCartItem(Request $req)
    {
        $item = CartItem::find($req->id);
        $item->delete();

        $count = Cart::where('customer_id', $req->user()->id)->first()->item()->count();

        $keranjang = Cart::where('customer_id', $req->user()->id)->first();

        return response()->json([
            'message' => 'berhasil',
            'items' => $keranjang->item,
            'count' => $count
        ], 200);
    }

    public function checkout(Request $req)
    {
        $o = new Order();
        $o->kode = 'EC/'.date('Ymd').'/ORDER/'.mt_rand(100000,999999);;
        $o->customer_id = $req->user()->id;
        $o->alamat_kirim = $req->alamat_kirim;
        $o->no_hp = $req->no_hp;
        $o->status = 'Pending';
        $o->total_harga = $req->total_harga;
        $o->save();

        $cart = Cart::where('customer_id', $req->user()->id)->first();

        foreach ($cart->item as $item) {
            $oi = new OrderItem();
            $oi->order_id = $o->id;
            $oi->product_id = $item->product_id;
            $oi->qty = $item->qty;
            $oi->save();

            $product = Product::find($item->product_id);
            if ($product->stok > 0) {
                $product->stok = $product->stok - $item->qty;
                $product->update();
            }
        }

        $cart->delete();

        return response()->json([
            'message' => 'berhasil',
        ], 200);
    }

    public function orderan(Request $req)
    {
        $data = Order::where('customer_id', $req->user()->id)->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'message' => 'berhasil',
            'orderan' => $data
        ], 200);
    }

    public function orderanCancel(Request $req)
    {
        $data = Order::find($req->id);
        $data->status = 'Batal';
        $data->update();

        foreach($data->item as $item) {
            $p = Product::find($item->product_id);
            $p->stok = $p->stok + $item->qty;
            $p->update();
        }

        $orderan = Order::where('customer_id', $req->user()->id)->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'message' => 'berhasil',
            'orderan' => $orderan
        ], 200);
    }

    public function favorites(Request $req)
    {
        $favorites = Favorite::where('customer_id', $req->user()->id)->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'message' => 'berhasil',
            'favorites' => $favorites,
        ], 200);
    }

    public function favoriteAction(Request $req)
    {
        $f = Favorite::where('customer_id', $req->user()->id)->where('product_id', $req->id)->first();
        if ($f) {
            $f->delete();
        } else {
            $f = new Favorite();
            $f->customer_id = $req->user()->id;
            $f->product_id = $req->id;
            $f->save();
        }

        $favorites = Favorite::where('customer_id', $req->user()->id)->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'message' => 'berhasil',
            'favorites' => $favorites,
        ], 200);
    }
}
