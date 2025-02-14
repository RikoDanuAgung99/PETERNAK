@extends('adminlte::page')

@section('title', 'Data Rekap')

@section('plugins.Datatables', true)

@section('content_header')
    <h1 class="m-0 text-dark">Data Rekap</h1>
@stop

@php
    $page = Request::get('page') ? Request::get('page') : 1;
    $no = ($page - 1) * $halaman + 1;
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Table Data Rekap </strong></h2>
                    <div class="form-group float-right">
                        {{-- <a href="{{ route('pakan.create') }}" class="btn btn-primary btn-md"> Tambah Penggunaan Pakan</a> --}}
                <a href="{{ route('print.rekap') }}"  target="_blank" class="btn btn-success btn-md"> Print Penggunaan Pakan</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="rekap">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>TANGGAL</th>
                                    <th>UMUR (HARI)</th>
                                    <th>JUMLAH KEMATIAN</th>
                                    {{-- <th>JENIS PAKAN</th> --}}
                                    <th>JUMLAH PAKAN</th>
                                    <th>JUMLAH OBAT</th>
                                    <th>BW ACTUAL</th>
                                    {{-- <th class="text-center">AKSI</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($rekap as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        {{-- <td></td> --}}
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->umur }}</td>
                                        <td>{{ $item->kematian }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ $item->jumlahObat }}</td>
                                        <td>{{ $item->bw_act }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- <span>{{ number_format(($page - 1) * $halaman + 1, 0) . ' - ' . number_format($no - 1, 0) . ' Of Over ' . number_format($rekap->total(), 0) . ' Result' }} --}}
                    </span>
                    <div class="card-footer">
                        {{ $rekap->links() }}
                    </div>
                </div>


            </div>
        </div>
    </div>
@stop

{{-- @push('js')
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
                            ]
        });
    });
</script>
@endpush --}}
