@extends('layouts.admin', ['title' => 'Product'])
@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $plural }}</h4>
                        <a class="btn btn-primary float-right" href="{{ route($url . 'create') }}"><i class="fa fa-plus"></i>
                            Create New {{ $singular }}</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            @include('alerts')
                            <div class="table-responsive">
                                <table id="dataTable" class="table datatable table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Created</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    {{--   <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
       <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.jqueryui.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
       <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
       <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
       <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: "{{ route($url . 'data') }}",
                aaSorting: [],
                columnDefs: [{
                    'targets': 0,
                    'checkboxes': {
                        'selectRow': true
                    }
                }, ],
                dom: '<"pull-left"B><"pull-right"f>rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
                columns: [
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },{
                        data: 'category.name',
                        name: 'category.name'
                    },{
                        data: 'title',
                        name: 'title'
                    },{
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
