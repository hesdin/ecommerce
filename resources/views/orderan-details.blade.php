@extends('layouts.app')

@section('content')
    {{-- <div class="page-heading">
        <h4>Orderan</h4>
    </div> --}}


    <div class="card">
        <div class="card-body">
            <h5>Nomor Transaksi {{ $data->kode }}</h5>
            <table>
                <tr>
                    <td>Nama</td>
                    <td class="px-4">:</td>
                    <td>{{ $data->customer->name }}</td>
                </tr>
                <tr>
                    <td>Alamat pengiriman</td>
                    <td class="px-4">:</td>
                    <td>{{ $data->alamat_kirim }}</td>
                </tr>
                <tr>
                    <td>Kontak</td>
                    <td class="px-4">:</td>
                    <td>+62{{ $data->no_hp }}</td>
                </tr>
                <tr>
                    <td>Tanggal dipesan</td>
                    <td class="px-4">:</td>
                    <td>{{ Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM YYYY') }}</td>
                </tr>
                <tr>
                    <td>Harga total</td>
                    <td class="px-4">:</td>
                    <td>Rp. {{ number_format($data->total_harga) }}</td>
                </tr>
                <tr>
                    <td>Harga Ongkir</td>
                    <td class="px-4">:</td>
                    <td>Rp. {{ number_format(15000) }}</td>
                </tr>
                <tr class="fw-bold">
                    <td>Total belanja</td>
                    <td class="px-4">:</td>
                    <td>Rp. {{ number_format($data->total_harga + 15000) }}</td>
                </tr>
            </table>


            <h5 class="mt-4">Detail pesanan</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->item as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->product->nama_produk }}</td>
                                <td>Rp. {{ number_format($order->product->harga) }}</td>
                                <td>{{ $order->qty }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($data->status != 'Selesai')
                <div class="clearfix">
                    <div class="float-end">
                        <form action="{{ route('orderan.update', $data->id) }}" class="d-inline" method="POST">
                            @csrf
                            @switch($data->status)
                                @case('Pending')
                                    <button class="btn btn-warning" type="submit">Proses</button>
                                @break

                                @case('Proses')
                                    <button class="btn btn-primary" type="submit">Kirim</button>
                                @break

                                @case('Dikirim')
                                    <button class="btn btn-success" type="submit">Selesai</button>
                                @break

                                @default
                                    <button class="btn btn-danger" type="submit">Batal</button>
                            @endswitch
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
