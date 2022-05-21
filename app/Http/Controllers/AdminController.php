<?php

namespace App\Http\Controllers;

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
        return view('orderan');
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
