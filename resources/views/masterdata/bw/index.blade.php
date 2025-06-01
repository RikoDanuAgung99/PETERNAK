@extends('adminlte::page')

@section('title', 'Data Bobot')

@section('plugins.Datatables', true)

@section('content_header')
    <h1 class="m-0 text-dark">Data Bobot</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Table Data Bobot </strong></h2>
                    <div class="form-group float-right">
                        @if (auth()->user()->level === 'ADMIN' || auth()->user()->level === 'PETERNAK')
                            <a href="{{ route('bw.create') }}" class="btn btn-primary btn-md"> Tambah Bobot</a>
                        @endif
                        <a href="{{ route('print.bw') }}" class="btn btn-success btn-md"> Print Bobot</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="bw">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>TANGGAL</th>
                                    <th>UMUR (HARI)</th>
                                    <th>BOBOT ACTUAL(g)</th>
                                    <th>BOBOT STANDAR(g)</th>
                                    <th>DIFFERENT BOBOT(g)</th>
                                    <th>KETERANGAN</th>
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
            var dataTable = $('#bw').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                stateSave: true,
                // scrollX: true,
                "order": [
                    [0, "desc"]
                ],
                ajax: '{{ route('get.bw') }}',
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
                        data: 'bw_act',
                        name: 'bw_act'
                    },
                    {
                        data: 'bw_std',
                        name: 'bw_std'
                    },
                    {
                        data: 'dif_bw',
                        name: 'dif_bw'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
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
