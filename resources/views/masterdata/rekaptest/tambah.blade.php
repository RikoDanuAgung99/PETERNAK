@extends('adminlte::page')

@section('title', 'Data Rekap')

@section('content_header')
    <h1 class="m-0 text-dark">Data Rekap</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Tambah Data Rekap</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('rekaptest.store') }}" method="post">
                        @csrf
                        <div class="form-group row mb-3">
                            <label class="form-label col-sm-2">TANGGAL</label>
                            <div class="col-sm-4">
                                <input type="date" name="tanggal" class="form-control"
                                    value="{{ old('tanggal') }}" required>
                            </div>

                            <label class="form-label col-sm-2">UMUR (HARI)</label>
                            <div class="col-sm-4">
                                <input type="text" name="umur" class="form-control"
                                    value="{{ old('umur') }}" required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="form-label col-sm-2">KEMATIAN (EKOR)</label>
                            <div class="col-sm-4">
                                <input type="number" name="kematian" class="form-control"
                                    value="{{ old('kematian') }}" required>
                            </div>

                            <label class="form-label col-sm-2">PAKAN (SAK)</label>
                            <div class="col-sm-4">
                                <input type="number" name="pakan" class="form-control"
                                    value="{{ old('pakan') }}" required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="form-label col-sm-2">OBAT (BUNGKUS@100g)</label>
                            <div class="col-sm-4">
                                <input type="number" name="obat" class="form-control"
                                    value="{{ old('obat') }}" required>
                            </div>

                            <label class="form-label col-sm-2">BOBOT (g)</label>
                            <div class="col-sm-4">
                                <input type="number" name="bobot" class="form-control"
                                    value="{{ old('bobot') }}" required>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info" id="simpan">SIMPAN</button>
                            <a href="{{ route('rekaptest.index') }}" class="btn btn-danger">BATAL</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop