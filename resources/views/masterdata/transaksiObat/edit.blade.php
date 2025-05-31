@extends('adminlte::page')

@section('title', 'Data Obat')

@section('content_header')
    <h1 class="m-0 text-dark">Data Obat</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Edit Data Penggunaan Obat</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('transaksiObat.update', $obat->id) }}" method="post">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">TANGGAL</label>
                            <div class="col-sm-4">
                                <input type="date" name="tanggal" class="form-control"
                                    value="{{ isset($obat) ? $obat->tanggal : old('tanggal') }}" required>
                            </div>

                            {{-- <label class="col-sm-2 col-form-label">UMUR (HARI)</label>
                            <div class="col-sm-4">
                                <input type="number" name="umur" class="form-control" 
                                    value="{{ isset($obat) ? $obat->umur : old('umur') }}" required>
                            </div> --}}
                        </div>

                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label">JENIS OBAT</label>
                            <div class="col-sm-4">
                                <select name="jenis_obat" class="form-control" required>
                                    <option value="" {{ (isset($obat) ? $obat->jenis_obat : old('jenis_obat')) == '' ? 'selected' : '' }} disabled>-- Pilih Jenis Obat --</option>
                                    <option value="ANTIBIOTIK" {{ $obat->jenis_obat == 'ANTIBIOTIK' ? 'selected' : '' }}>
                                        ANTIBIOTIK</option>
                                    <option value="PROBIOTIK" {{ $obat->jenis_obat == 'PROBIOTIK' ? 'selected' : '' }}>PROBIOTIK
                                    </option>
                                    <option value="VITAMIN" {{ $obat->jenis_obat == 'VITAMIN' ? 'selected' : '' }}>VITAMIN
                                    </option>
                                </select>
                            </div>

                            <label class="col-sm-2 col-form-label">STOK AWAL</label>
                            <div class="col-sm-4">
                                <input type="text" name="stok_awal" class="form-control"
                                    value="{{ isset($obat) ? $obat->stok_awal : old('stok_awal') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">JUMLAH OBAT (BUNGKUS/100g)</label>
                            <div class="col-sm-4">
                                <input type="number" name="jumlah" class="form-control"
                                    value="{{ isset($obat) ? $obat->jumlah : old('jumlah') }}" >
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info" id="simpan">SIMPAN</button>
                            <a href="{{ route('transaksiObat.index') }}" class="btn btn-danger">BATAL</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
