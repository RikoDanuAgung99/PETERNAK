@extends('adminlte::page')

@section('title', 'Data Pakan')

@section('plugins.Datatables', true)

@section('content_header')
    <h1 class="m-0 text-dark">Data Pakan</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><strong>Table Data Penggunaan Pakan </strong></h2>
                <div class="form-group float-right">
                <a href="{{ route('pakan.create') }}" class="btn btn-primary btn-md"> Tambah Penggunaan Pakan</a>
                <a href="{{ route('print.pakan') }}" target="_blank" class="btn btn-success btn-md"> Print Penggunaan Pakan</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="pakan">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>TANGGAL</th>
                                <th>UMUR (HARI)</th>
                                <th>NAMA PAKAN</th>
                                <th>JENIS PAKAN</th>
                                <th>JUMLAH PAKAN</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        var dataTable = $('#pakan').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            stateSave: true,
            // scrollX: true,
            "order": [
                [0, "desc"]
            ],
            ajax: '{{ route('get.pakan') }}',
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'umur',
                    name: 'umur'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'jenis',
                    name: 'jenis'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah'
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false,
                    'sClass': 'text-center'
                }
            ]
        });
    });
</script>
@endpush
