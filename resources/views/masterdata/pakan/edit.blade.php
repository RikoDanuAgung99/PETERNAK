@extends('adminlte::page')

@section('title', 'Data Pakan')

@section('content_header')
    <h1 class="m-0 text-dark">DATA PAKAN</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>EDIT DATA PENGGUNAAN PAKAN</strong></h3>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('pakan.update', $pakan->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="form-group row mb-3">
                <label class="form-label col-sm-2 col-form-label">TANGGAL</label>
                <div class="col-sm-4">
                    <input type="date" name="tanggal" class="form-control" 
                    value="{{ isset($pakan) ? $pakan->tanggal : old('pakan') }}" required>
                </div>

                <label class="form-label col-sm-2 col-form-label">UMUR (HARI)</label>
                <div class="col-sm-4">
                    <input type="text" name="umur" class="form-control" 
                    value="{{ isset($pakan) ? $pakan->umur : old('pakan') }}" required>
                </div>
            </div>

            <div class="form-group row mb-3">

                <label class="form-label col-sm-2">JENIS PAKAN</label>
                        <div class="col-sm-4">
                            <select name="jenis" class="form-control" required>
                                <option value="" selected disabled>-- Pilih Jenis Pakan --
                                </option>
                                <option value="STARTER" {{ $pakan->jenis == 'STARTER' ? 'selected' : '' }}>STARTER</option>
                                <option value="PRESTARTER" {{ $pakan->jenis == 'PRESTARTER' ? 'selected' : '' }}>PRESTARTER</option>
                                <option value="FINISHER" {{ $pakan->jenis == 'FINISHER' ? 'selected' : '' }}>FINISHER</option> 
                            </select>
                        </div>
            </div>

            <div class="form-group row mb-3">
                <label class="form-label col-sm-2 col-form-label">JUMLAH PAKAN (SAK)</label>
                <div class="col-sm-4">
                    <input type="number" name="jumlah" class="form-control" 
                    value="{{ isset($pakan) ? $pakan->jumlah : old('pakan') }}" required>
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

