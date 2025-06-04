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
                    <h3 class="card-title"><strong>Tambah Data Obat</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('transaksiObat.store') }}" method="post">
                        @csrf

                        <div class="form-group row mb-3">
                            <label class="col-sm-1 col-form-label">TANGGAL</label>
                            <div class="col-sm-3">
                                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}"
                                    required>
                            </div>
                            <label class="col-sm-1 col-form-label">KANDANG</label>
                            <div class="col-sm-3">
                                <select name="kandang_id" id="kandang_id" class="form-control" required>
                                    <option value="">-- Pilih Kandang --</option>
                                    @foreach ($kandang as $item)
                                        <option value="{{ $item->id }}"
                                            {{ request('kandang_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-sm-1 col-form-label">JENIS OBAT</label>
                            <div class="col-sm-3">
                                <select name="jenis_obat" id="jenis_obat" class="form-control" required>
                                    <option value="" selected disabled>-- Pilih Jenis Obat --</option>
                                    <option value="ANTIBIOTIK">ANTIBIOTIK</option>
                                    <option value="PROBIOTIK">PROBIOTIK</option>
                                    <option value="VITAMIN">VITAMIN</option>
                                </select>
                            </div>

                            <label class="col-sm-1 col-form-label">STOK AWAL</label>
                            <div class="col-sm-3">
                                <input type="number" name="stok_awal" class="form-control" value="{{ old('stok_awal') }}"
                                    required>
                            </div>

                            <label class="col-sm-1 col-form-label">JUMLAH OBAT</label>
                            <div class="col-sm-3">
                                <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah') }}"
                                    required>
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
