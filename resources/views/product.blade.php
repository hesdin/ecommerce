@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
@endpush

@section('content')
    <div class="page-heading">
        <h4>Product</h4>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">

            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" fill="currentColor"
                class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg>
            <span class="align-middle">{{ $message }}</span>
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    @endif

    <div class="card">
        <div class="card-header">

            <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahProduk">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                    <path
                        d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z">
                    </path>
                </svg>
                <span class="align-middle ms-2">Tambah Product</span>

            </button>


        </div>
        <div class="card-body">
            <table class="table" id="table1">
                <thead>
                    <th>Nama Produk</th>
                    <th>Tipe Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->nama_produk }}</td>
                            <td>{{ $product->tipe_produk }}</td>
                            <td>@currency($product->harga)</td>
                            <td>{{ $product->stok }}</td>
                            <td>
                                <span><a href="{{ route('show.product', $product->id) }}"><i
                                            class="bi bi-pencil-square text-primary"></i></a></span>
                                <span>
                                    <a href="{{ route('destroy.product', $product->id) }}"
                                        onclick="event.preventDefault(); document.getElementById('destroyProduct{{ $product->id }}').submit();">
                                        <i class="bi bi-trash ms-2 text-danger"></i>
                                    </a>

                                    <form action="{{ route('destroy.product', $product->id) }}" method="POST"
                                        class="d-none" id="destroyProduct{{ $product->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL --}}

    <!--Tambah Produk -->
    <div class="modal fade text-left" id="tambahProduk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel18">Tambah Produk</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>

                <form id="#" class="form form-vertical" action="{{ route('store.product') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Nama Produk</label>
                                        <input type="text" id="first-name-vertical" class="form-control"
                                            name="nama_produk" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Tipe Produk</label>
                                        <input type="text" id="first-name-vertical" class="form-control"
                                            name="tipe_produk" required>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="contact-info-vertical">Deskripsi Produk</label>
                                        <div class="form-group with-title mb-3">
                                            <textarea name="deskripsi" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                            <label>Tulis deskripsi produk</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Stok</label>
                                                <input type="number" id="first-name-vertical" class="form-control"
                                                    name="stok" min="1" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="first-name-vertical">Harga</label>
                                                <input type="text" id="harga" class="form-control" name="harga" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="contact-info-vertical">Gambar Produk</label>
                                        <input class="form-control" type="file" id="formFile" name="img" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary ml-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tambah</span>
                        </button>
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Batal</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('div.alert').delay(2000).slideUp(300);
    </script>

    <script>
        /* Harga Rupiah */
        // var dengan_rupiah = document.getElementById('harga');
        // dengan_rupiah.addEventListener('keyup change', function(e) {
        //     dengan_rupiah.value = formatRupiah(this.value);
        // });

        $('#harga').on('keyup', function(e) {
            this.value = formatRupiah(this.value);
        })

        /* Fungsi */
        function formatRupiah(angka) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
        }

        // Clear Form
        const form = document.getElementById('product_form');

        form.addEventListener('submit', function handleSubmit(event) {
            event.preventDefault();

            // 👇️ Send data to server here

            // 👇️ Reset form here
            form.reset();
        });
    </script>

    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
@endpush
