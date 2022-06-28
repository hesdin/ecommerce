@extends('layouts.app')

@section('content')
    <div style="min-height: 80vh">
        <div class="page-heading">
            <h4>Pengaturan</h4>
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

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">

                        <div class="clearfix">
                            <button class="btn btn-sm btn-primary float-end" type="button">
                                <span class="align-middle"><i class="bi bi-file-earmark-check"></i> Simpan Pengaturan</span>
                            </button>
                        </div>



                    </div>
                    <div class="card-body">
                        <h5>Data Rekening</h5>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="bank" class="form-label">Bank</label>
                                <input type="email" class="form-control" id="bank" name="bank">
                            </div>

                            <div class="col-md-6">
                                <label for="rekening" class="form-label">No. Rekening</label>
                                <input type="email" class="form-control" id="rekening" name="rekening">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="pemilik" class="form-label">Pemilik Rekening</label>
                            <input type="email" class="form-control" id="pemilik" name="pemilik">
                        </div>

                        <hr>

                        <h5>Data Aplikasi</h5>
                        <div class="mb-3">
                            <label for="ongkir" class="form-label">Ongkos Kirim</label>
                            <input type="email" class="form-control" id="ongkir" name="ongkir">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center py-5">
                <img src="{{ asset('assets/images/settings.svg') }}" class="w-75">
            </div>
        </div>
    </div>
@endsection
