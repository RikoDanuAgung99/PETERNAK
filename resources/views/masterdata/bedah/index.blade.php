@extends('adminlte::page')

@section('title', 'Data Bedah')

@section('plugins.Datatables', true)

@section('content_header')
    <h1 class="m-0 text-dark">Data Bedah</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><strong>Table Data Bedah</strong></h2>
                <div class="form-group float-right">
                <a href="{{ route('bedah.create') }}" class="btn btn-primary btn-md"> Tambah Bedah</a>
                <a href="{{ route('print.bedah') }}" class="btn btn-success btn-md"> Print Bedah</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="bedah">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>TANGGAL</th>
                                <th>UMUR (HARI)</th>
                                <th>GEJALA</th>
                                <th>DIAGNOSIS</th>
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
        var dataTable = $('#bedah').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            stateSave: true,
            // scrollX: true,
            "order": [
                [0, "desc"]
            ],
            ajax: '{{ route('get.bedah') }}',
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
                    data: 'gejala',
                    name: 'gejala'
                },
                {
                    data: 'diagnosis',
                    name: 'diagnosis'
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
