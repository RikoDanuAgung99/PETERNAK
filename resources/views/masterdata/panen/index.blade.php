@extends('adminlte::page')

@section('title', 'Transaksi Panen')

@php
    $page = Request::get('page') ? Request::get('page') : 1;
    $no = ($page - 1) * $halaman + 1;
@endphp

@section('content_header')
    <h1 class="m-0 text-dark">Data Panen</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Table Data Panen </strong></h2>
                    <div class="form-group float-right">
                        @if (auth()->user()->level === 'ADMIN' || auth()->user()->level === 'TS')
                            <a href="{{ route('panen.create') }}" class="btn btn-primary btn-md"> Tambah Panen</a>
                        @endif
                        <a href="{{ route('print.panen') }}" target="_blank" class="btn btn-success btn-md"> Print Panen</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="panen">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>TANGGAL</th>
                                    <th>NO DOC</th>
                                    <th>JUMLAH PANEN</th>
                                    <th>TONASE PANEN</th>
                                    <th>RATA RATA</th>
                                    <th>HARGA KONTRAK</th>
                                    <th>TOTAL HARGA</th>

                                    @if (auth()->user()->level === 'ADMIN' || auth()->user()->level === 'TS')
                                        <th class="text-center">AKSI</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($panen as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->no_doc }}</td>
                                        <td>{{ $item->jumlah_panen }}</td>
                                        <td>{{ $item->tonase_panen }}</td>
                                        <td>{{ $item->rata_rata }} KG</td>
                                        <td>Rp. {{ $item->harga_kontrak }}</td>
                                        <td>Rp. {{ $item->total_harga }}</td>
                                        @if (auth()->user()->level === 'ADMIN' || auth()->user()->level === 'TS')
                                            <td class="text-center">
                                                <a href="{{ route('panen.edit', $item->id) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('panen.destroy', $item->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Hapus data ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $panen->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
@endpush
