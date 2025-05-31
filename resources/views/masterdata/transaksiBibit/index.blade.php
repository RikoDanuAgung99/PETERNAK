@extends('adminlte::page')

@section('title', 'Transaksi Bibit')

{{-- @section('plugins.Datatables', true) --}}
@php
    $page = Request::get('page') ? Request::get('page') : 1;
    $no = ($page - 1) * $halaman + 1;
@endphp

@section('content_header')
    <h1 class="m-0 text-dark">Data Bibit</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Table Data Bibit </strong></h2>
                    <div class="form-group float-right">
                        <a href="{{ route('transaksiBibit.create') }}" class="btn btn-primary btn-md"> Tambah Bibit</a>
                        <a href="{{ route('print.transaksiBibit') }}" target="_blank" class="btn btn-success btn-md"> Print Bibit</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="bibit">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>TANGGAL</th>
                                    <th>NO DOC</th>
                                    <th>JENIS BIBIT</th>
                                    <th>JUMLAH BIBIT</th>
                                    <th>HARGA BIBIT</th>
                                    <th>TOTAL HARGA</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($listBibit as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->no_doc }}</td>
                                        <td>{{ $item->jenis_bibit }}</td>
                                        <td>{{ $item->jumlah_bibit }}</td>
                                        <td>{{ $item->harga_bibit }}</td>
                                        <td>{{ $item->total_harga }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('transaksiBibit.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('transaksiBibit.destroy', $item->id) }}" method="POST"
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
                        {{ $listBibit->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
@endpush
