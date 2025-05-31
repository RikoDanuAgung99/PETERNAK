@extends('adminlte::page')

@section('title', 'Transaksi Pakan')

{{-- @section('plugins.Datatables', true) --}}
{{-- @php
    $page = Request::get('page') ? Request::get('page') : 1;
    $no = ($page - 1) * $halaman + 1;
@endphp --}}

@section('content_header')
    <h1 class="m-0 text-dark">Data Pakan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Table Data Pakan </strong></h2>
                    <div class="form-group float-right">
                        <a href="{{ route('transaksiPakan.create') }}" class="btn btn-primary btn-md"> Tambah Pakan</a>
                        <a href="{{ route('print.transaksiPakan') }}" target="_blank" class="btn btn-success btn-md"> Print Pakan</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="obat">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>TANGGAL</th>
                                    <th>NO DOC</th>
                                    <th>JENIS PAKAN</th>
                                    <th>JUMLAH PAKAN</th>
                                    <th>HARGA PAKAN</th>
                                    <th>TOTAL HARGA</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($listPakan as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->no_doc }}</td>
                                        <td>{{ $item->jenis_pakan }}</td>
                                        <td>{{ $item->jumlah_pakan }}</td>
                                        <td>{{ $item->harga_pakan }}</td>
                                        <td>{{ $item->total_harga }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('transaksiPakan.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('transaksiPakan.destroy', $item->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Hapus data ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $listPakan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
@endpush
