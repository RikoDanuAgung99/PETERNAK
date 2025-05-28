@extends('adminlte::page')

@section('title', 'Data Bedah')

@section('content_header')
    <h1 class="m-0 text-dark">Data Bedah</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Edit Data Bedah</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('bedah.update', $bedah->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">TANGGAL</label>
                            <div class="col-sm-4">
                                <input type="date" name="tanggal" class="form-control"
                                    value="{{ isset($bedah) ? $bedah->tanggal : old('tanggal') }}" required>
                            </div>

                            <label class="col-sm-2 col-form-label">UMUR (HARI)</label>
                            <div class="col-sm-4">
                                <input type="number" name="umur" class="form-control"
                                    value="{{ isset($bedah) ? $bedah->umur : old('umur') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">GEJALA</label>
                            <div class="col-sm-4">
                                <input type="text" name="gejala" class="form-control"
                                    value="{{ isset($bedah) ? $bedah->gejala : old('gejala') }}" required>
                            </div>

                            <label class="col-sm-2 col-form-label">DIAGNOSIS</label>
                            <div class="col-sm-4">
                                <input type="text" name="diagnosis" class="form-control"
                                    value="{{ isset($bedah) ? $bedah->diagnosis : old('diagnosis') }}" required>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info" id="simpan">SIMPAN</button>
                            <a href="{{ route('bedah.index') }}" class="btn btn-danger">BATAL</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
