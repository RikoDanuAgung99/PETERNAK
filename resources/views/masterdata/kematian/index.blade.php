@extends('adminlte::page')

@section('title', 'Data Kematian')

@section('plugins.Datatables', true)

@section('content_header')
    <h1 class="m-0 text-dark">Data Kematian</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><strong>Table Data Kematian</strong></h2>
                <div class="form-group float-right">
                <a href="{{ route('kematian.create') }}" class="btn btn-primary btn-md"> Tambah Kematian</a>
                <a href="{{ route('print.kematian') }}" class="btn btn-success btn-md"> Print Kematian</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="kematian">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>TANGGAL</th>
                                <th>UMUR (HARI)</th>
                                <th>KEMATIAN (EKOR)</th>
                                <th>STANDAR KEMATIAN (EKOR)</th>
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
        var dataTable = $('#kematian').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            stateSave: true,
            // scrollX: true,
            "order": [
                [0, "desc"]
            ],
            ajax: '{{ route('get.kematian') }}',
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
                    data: 'kematian',
                    name: 'kematian'
                },
                {
                    data: 'std_kematian',
                    name: 'std_kematian'
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
