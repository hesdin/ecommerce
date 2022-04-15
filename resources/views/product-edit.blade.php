@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Produk</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical" action="{{ route('update.product', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Nama Produk</label>
                                            <input type="text" id="first-name-vertical" class="form-control"
                                                name="nama_produk" value="{{ $product->nama_produk }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Tipe Produk</label>
                                            <input type="text" id="first-name-vertical" class="form-control"
                                                name="tipe_produk" value="{{ $product->tipe_produk }}" required>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Deskripsi Produk</label>
                                            <div class="form-group with-title mb-3">
                                                <textarea name="deskripsi" class="form-control" id="exampleFormControlTextarea1" rows="3"
                                                    required>{{ $product->deskripsi }}</textarea>
                                                <label>Tulis deskripsi produk</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">Harga</label>
                                                    <input type="number" id="#" class="form-control" name="harga"
                                                        value="{{ $product->harga }}" required>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-vertical">Stok</label>
                                                    <input type="number" id="first-name-vertical" class="form-control"
                                                        name="stok" min="1" value="{{ $product->stok }}" required>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Gambar Produk</label><br>
                                            <div class="col-4 pb-2">
                                                <img src="{{ asset('img/' . $product->img) }}" class="img-thumbnail"
                                                    alt="...">
                                            </div>
                                            <input class="form-control" type="file" id="formFile" name="img">
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                        <a href="{{ route('product') }}"
                                            class="btn btn-light-secondary me-1 mb-1">Batal</a>
                                    </div>

                                </div>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
