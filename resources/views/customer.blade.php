@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
@endpush

@section('content')
    <div class="page-heading">
        <h4>Customer</h4>
    </div>
    <div class="card">
        <div class="card-header">
            Daftar Customer
        </div>
        <div class="card-body">
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <div class="dataTable-top">
                    <div class="dataTable-dropdown"><select class="dataTable-selector form-select">
                            <option value="5">5</option>
                            <option value="10" selected="">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                        </select><label>entries per page</label></div>
                    <div class="dataTable-search"><input class="dataTable-input" placeholder="Search..." type="text"></div>
                </div>
                <div class="dataTable-container">
                    <table class="table dataTable-table" id="table1">
                        <thead>
                            <tr>
                                <th data-sortable="" style="width: 11.8463%;"><a href="#" class="dataTable-sorter">Name</a>
                                </th>
                                <th data-sortable="" style="width: 41.8356%;"><a href="#" class="dataTable-sorter">Email</a>
                                </th>
                                <th data-sortable="" style="width: 18.8901%;"><a href="#" class="dataTable-sorter">Phone</a>
                                </th>
                                <th data-sortable="" style="width: 16.3287%;"><a href="#" class="dataTable-sorter">City</a>
                                </th>
                                <th data-sortable="" style="width: 11.0993%;"><a href="#"
                                        class="dataTable-sorter">Status</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Graiden</td>
                                <td>vehicula.aliquet@semconsequat.co.uk</td>
                                <td>076 4820 8838</td>
                                <td>Offenburg</td>
                                <td>
                                    <span class="badge bg-success">Active</span>
                                </td>
                            </tr>

                            <tr>
                                <td>Deacon</td>
                                <td>Duis.a.mi@sociisnatoquepenatibus.com</td>
                                <td>07740 599321</td>
                                <td>Karapınar</td>
                                <td>
                                    <span class="badge bg-success">Active</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="dataTable-bottom">
                    <div class="dataTable-info">Showing 1 to 10 of 26 entries</div>
                    <ul class="pagination pagination-primary float-end dataTable-pagination">
                        <li class="page-item pager"><a href="#" class="page-link" data-page="1">‹</a></li>
                        <li class="page-item active"><a href="#" class="page-link" data-page="1">1</a></li>
                        <li class="page-item"><a href="#" class="page-link" data-page="2">2</a></li>
                        <li class="page-item"><a href="#" class="page-link" data-page="3">3</a></li>
                        <li class="page-item pager"><a href="#" class="page-link" data-page="2">›</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
@endpush
