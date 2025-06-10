@extends('adminlte::page')

@section('title', 'Data Bedah')

@section('content_header')
    <h1 class="m-0 text-dark">DATA BEDAH</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>TAMBAH DATA BEDAH</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('bedah.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-3">
                            <label class="form-label col-sm-2">TANGGAL</label>
                            <div class="col-sm-4">
                                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}"
                                    required>
                            </div>

                            <label class="form-label col-sm-2">UMUR (HARI)</label>
                            <div class="col-sm-4">
                                <input type="text" name="umur" class="form-control" value="{{ old('umur') }}"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="form-label col-sm-2">GEJALA</label>
                            <div class="col-sm-4">
                                <input type="text" name="gejala" class="form-control" value="{{ old('gejala') }}"
                                    required>
                            </div>

                            <label class="form-label col-sm-2">DIAGNOSIS</label>
                            <div class="col-sm-4">
                                <input type="text" name="diagnosis" class="form-control" value="{{ old('diagnosis') }}"
                                    required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="form-label col-sm-2">FOTO</label>
                            <div class="col-sm-4">
                                <input type="file" name="images" class="form-control" accept="image/*">
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
