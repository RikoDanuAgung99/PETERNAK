@extends('adminlte::page')

@section('title', 'Data Obat')

@section('plugins.Datatables', true)

@section('content_header')
    <h1 class="m-0 text-dark">Data Obat</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Table Data Penggunaan Obat </strong></h2>
                    <div class="form-group float-right">
                        @if (auth()->user()->level === 'ADMIN' || auth()->user()->level === 'PETERNAK')
                            <a href="{{ route('obat.create') }}" class="btn btn-primary btn-md"> Tambah Penggunaan Obat</a>
                        @endif
                        <a href="{{ route('print.obat') }}" class="btn btn-success btn-md"> Print Penggunaan Obat</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="obat">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>TANGGAL</th>
                                    <th>UMUR (HARI)</th>
                                    <th>NAMA OBAT</th>
                                    <th>JENIS OBAT</th>
                                    <th>JUMLAH OBAT (BUNGKUS@100g)</th>
                                    @if (auth()->user()->level === 'ADMIN' || auth()->user()->level === 'PETERNAK')
                                        <th class="text-center">AKSI</th>
                                    @endif
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
            var dataTable = $('#obat').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                stateSave: true,
                // scrollX: true,
                "order": [
                    [0, "desc"]
                ],
                ajax: '{{ route('get.obat') }}',
                columns: [{
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
