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
                    <h3 class="card-title"><strong>Edit Data Rekap</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('rekaptest.update', $rekaptest->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">TANGGAL</label>
                            <div class="col-sm-4">
                                <input type="date" name="tanggal" class="form-control"
                                    value="{{ isset($rekaptest) ? $rekaptest->tanggal : old('tanggal') }}" required>
                            </div>

                            <label class="col-sm-2 col-form-label">UMUR (HARI)</label>
                            <div class="col-sm-4">
                                <input type="number" name="umur" class="form-control"
                                    value="{{ isset($rekaptest) ? $rekaptest->umur : old('umur') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">KEMATIAN (EKOR)</label>
                            <div class="col-sm-4">
                                <input type="number" name="kematian" class="form-control"
                                    value="{{ isset($rekaptest) ? $rekaptest->kematian : old('kematian') }}" required>
                            </div>

                            <label class="col-sm-2 col-form-label">PAKAN (SAK)</label>
                            <div class="col-sm-4">
                                <input type="number" name="pakan" class="form-control"
                                    value="{{ isset($rekaptest) ? $rekaptest->pakan : old('pakan') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">OBAT (BUNGKUS@100g)</label>
                            <div class="col-sm-4">
                                <input type="number" name="obat" class="form-control"
                                    value="{{ isset($rekaptest) ? $rekaptest->obat : old('obat') }}" required>
                            </div>

                            <label class="col-sm-2 col-form-label">BOBOT (g)</label>
                            <div class="col-sm-4">
                                <input type="number" name="bobot" class="form-control"
                                    value="{{ isset($rekaptest) ? $rekaptest->bobot : old('bobot') }}" required>
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
