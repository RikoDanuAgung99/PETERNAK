@extends('adminlte::page')

@section('title', 'Data Pakan')

@section('content_header')
    <h1 class="m-0 text-dark">Data Pakan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Tambah Data Penggunaan Pakan</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('pakan.store') }}" method="post">
                        @csrf
                        <div class="form-group row mb-3">
                <label class="form-label col-sm-2 col-form-label">TANGGAL</label>
                <div class="col-sm-4">
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
                </div>

                <label class="form-label col-sm-2 col-form-label">UMUR (HARI)</label>
                <div class="col-sm-4">
                    <input type="text" name="umur" class="form-control" value="{{ old('umur') }}" required>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label for="nama" class="form-label col-sm-2 col-form-label">NAMA PAKAN</label>
                <div class="col-sm-4">
                    <select name="nama" id="nama" class="form-control" required>
                        <option value="" selected disabled>-- Pilih Nama Pakan --</option>
                        <option value="NEWHOPE">NEWHOPE</option>
                        <option value="JAPFA">JAPFA</option>
                        <option value="POKPHAND">POKPHAND</option>
                    </select>
                </div>

                <label for="jenis" class="form-label col-sm-2 col-form-label">JENIS PAKAN</label>
                <div class="col-sm-4">
                    <select name="jenis" id="jenis" class="form-control" required>
                        <option value="" selected disabled>-- Pilih Jenis Pakan --</option>
                        <option value="STARTER">STARTER</option>
                        <option value="PRESTARTER">PRESTARTER</option>
                        <option value="FINISHER">FINISHER</option>
                    </select>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label class="form-label col-sm-2 col-form-label">JUMLAH PAKAN</label>
                <div class="col-sm-4">
                    <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah') }}" required>
                </div>
            </div>

            <div class="card-footer text-center">
                <button type="submit" class="btn btn-info" id="simpan">SIMPAN</button>
                <a href="{{ route('pakan.index') }}" class="btn btn-danger">BATAL</a>
            </div>
        </form>
    </div>
</div>
@stop
