<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }
    public function customer()
    {
        $user = User::all();

        return view('customer', ['data' => $user]);
    }

    public function deleteCustomer($id)
    {
        $user = User::find($id);

        $nama = $user->name;

        if ($user->pict != 'default.png') {
            $destination = public_path('img/u/' . $user->pict);
            File::delete($destination);
        }

        $user->delete();

        return redirect()->route('customer')->with('success', 'Customer '. $nama .' berhasil dihapus');
    }

    public function product()
    {
        $products = Products::all();

        return view('product', ['products' => $products]);
    }

    public function storeProduct(Request $req)
    {
        $product = new Products();


        $product->nama_produk = $req->nama_produk;
        $product->tipe_produk = $req->tipe_produk;
        $product->deskripsi = $req->deskripsi;
        $product->stok = $req->stok;
        $product->harga = str_replace('.', '', $req->harga);

        if ($req->file('img')) {
            $file = $req->file('img');
            $fileName = date('mY') . '-' . Str::random(9) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/p/'), $fileName);
            $product->img = $fileName;
        }

        $product->save();

        return back()->with('success', 'Produk Berhasil Ditambahkan');
    }

    public function showProduct($id)
    {
        $product = Products::findOrFail($id);

        return view('product-edit', ['product' => $product]);
    }

    public function updateProduct(Request $req, $id)
    {
        $product = Products::findOrFail($id);

        $product->nama_produk = $req->nama_produk;
        $product->tipe_produk = $req->tipe_produk;
        $product->deskripsi = $req->deskripsi;
        $product->stok = $req->stok;
        $product->harga = str_replace('.', '', $req->harga);

        if ($req->hasFile('img')) {
            $destination = public_path('img/p/' . $product->img);
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $req->file('img');
            $fileName = date('mY') . '-' . Str::random(9) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $fileName);
            $product->img = $fileName;
        }

        $product->update();

        return redirect()->route('product')->with('success', 'Produk Berhasil Diubah');
    }

    public function destroyProduct($id)
    {
        $product = Products::findOrFail($id);

        $imgPath = public_path('img/p/' . $product->img);
        File::delete($imgPath);

        $product->delete();

        return back()->with('success', 'Produk Berhasil Dihapus');
    }

    // ORDERAN
    public function orderan()
    {
        $orders = Order::orderBy('created_at', "DESC")->get();
        return view('orderan', ['daftarOrderan' => $orders]);
    }

    public function orderanDetails($id)
    {
        $order = Order::find($id);
        return view('orderan-details', ['data' => $order]);
    }

    public function orderanUpdate(Request $req, $id)
    {
        $order = Order::find($id);

        // $order->status = $req->status;

        $order->save();

        return redirect()->route('orderan');
    }

    // ADMIN
    public function admin()
    {
        return view('admin');
    }

    // LAPORAN
    public function laporan()
    {
        return view('laporan');
    }
}
