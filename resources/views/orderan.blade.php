@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
@endpush

@section('content')
    <div class="page-heading">
        <h4>Orderan</h4>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">

            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" fill="currentColor"
                class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg>
            <span class="align-middle">{{ Session::get('success') }}</span>
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Daftar Orderan
        </div>
        <div class="card-body">
            <table class="table" id="table1">
                <thead>
                    <th>Customer</th>
                    <th>Alamat</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($daftarOrderan as $orderan)
                        <tr>
                            <td>{{ $orderan->customer->name }}</td>
                            <td>{{ $orderan->alamat_kirim }}</td>
                            <td>{{ $orderan->total_harga }}</td>
                            <td>{{ $orderan->status }}</td>
                            <td>
                                <span>
                                    <button class="btn btn-sm" onclick="document.location.href = '{{ route('orderan.details', $orderan->id) }}'"><i class="bi bi-arrow-right-square text-primary"></i></button>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1, {
            sortable: false
        });
    </script>
@endpush
