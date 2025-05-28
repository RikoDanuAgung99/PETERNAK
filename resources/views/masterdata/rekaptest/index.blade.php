@extends('adminlte::page')

@section('title', 'Data Rekap')

@section('plugins.Datatables', true)

@section('content_header')
    <h1 class="m-0 text-dark">Data Rekap</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><strong>Table Data Rekap</strong></h2>
                <div class="form-group float-right">
                <a href="{{ route('rekaptest.create') }}" class="btn btn-primary btn-md"> Tambah Rekap</a>
                <a href="{{ route('print.rekaptest') }}" class="btn btn-success btn-md"> Print Rekap</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="rekaptest">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>TANGGAL</th>
                                <th>UMUR (HARI)</th>
                                <th>KEMATIAN (EKOR)</th>
                                <th>PAKAN (SAK)</th>
                                <th>OBAT (BUNGKUS@100g)</th>
                                <th>BOBOT (g)</th>
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
        var dataTable = $('#rekaptest').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            stateSave: true,
            // scrollX: true,
            "order": [
                [0, "desc"]
            ],
            ajax: '{{ route('get.rekaptest') }}',
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
                    data: 'pakan',
                    name: 'pakan'
                },
                {
                    data: 'obat',
                    name: 'obat'
                },
                {
                    data: 'bobot',
                    name: 'bobot'
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
