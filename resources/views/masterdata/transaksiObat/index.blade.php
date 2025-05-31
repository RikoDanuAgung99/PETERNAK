@extends('adminlte::page')

@section('title', 'Transaksi Obat')

{{-- @section('plugins.Datatables', true) --}}
@php
    $page = Request::get('page') ? Request::get('page') : 1;
    $no = ($page - 1) * $halaman + 1;
@endphp

@section('content_header')
    <h1 class="m-0 text-dark">Data Obat</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Table Data Obat </strong></h2>
                    <div class="form-group float-right">
                        <a href="{{ route('transaksiObat.create') }}" class="btn btn-primary btn-md"> Tambah Obat</a>
                        <a href="{{ route('print.transaksiObat') }}" target="_blank" class="btn btn-success btn-md"> Print Obat</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="obat">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>TANGGAL</th>
                                    <th>JENIS OBAT</th>
                                    <th>STOK OBAT</th>
                                    <th>JUMLAH</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($listObat as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->jenis_obat }}</td>
                                        <td>{{ $item->stok_awal }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('transaksiObat.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('transaksiObat.destroy', $item->id) }}" method="POST"
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
                        {{ $listObat->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
@endpush
