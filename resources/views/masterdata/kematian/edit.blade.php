@extends('adminlte::page')

@section('title', 'Data Kematian')

@section('content_header')
    <h1 class="m-0 text-dark">DATA KEMATIAN</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>EDIT DATA KEMATIAN</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('kematian.update', $kematian->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        
                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label">TANGGAL</label>
                            <div class="col-sm-3">
                                <input type="date" name="tanggal" class="form-control"
                                    value="{{ isset($kematian) ? $kematian->tanggal : old('tanggal') }}" required>
                            </div>

                            <label class="col-sm-1 col-form-label">UMUR (HARI)</label>
                            <div class="col-sm-3">
                                <input type="number" name="umur" class="form-control"
                                    value="{{ isset($kematian) ? $kematian->umur : old('umur') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label">KEMATIAN (EKOR)</label>
                            <div class="col-sm-3">
                                <input type="number" name="kematian" class="form-control"
                                    value="{{ isset($kematian) ? $kematian->kematian : old('kematian') }}" required>
                            </div>

                            <label class="col-sm-1 col-form-label">STANDAR KEMATIAN (EKOR)</label>
                            <div class="col-sm-3">
                                <input type="number" name="std_kematian" class="form-control"
                                    value="{{ isset($kematian) ? $kematian->std_kematian : old('std_kematian') }}" required>
                            </div>
                             <label class="col-sm-1 col-form-label">PENYEBAB KEMATIAN</label>
                            <div class="col-sm-3">
                                <input type="text" name="keterangan" class="form-control"
                                    value="{{ isset($kematian) ? $kematian->keterangan : old('keterangan') }}" required>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info" id="simpan">SIMPAN</button>
                            <a href="{{ route('kematian.index') }}" class="btn btn-danger">BATAL</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
