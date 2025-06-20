@extends('adminlte::page')

@section('title', 'Data Bobot')

@section('content_header')
    <h1 class="m-0 text-dark">DATA BOBOT</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>TAMBAH DATA BOBOT</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('bw.store') }}" method="post">
                        @csrf
                        
                        <div class="form-group row mb-3">
                            <label class="form-label col-sm-2">TANGGAL</label>
                            <div class="col-sm-4">
                                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
                            </div>
                            
                            <label class="form-label col-sm-2">UMUR (HARI)</label>
                            <div class="col-sm-4">
                                <input type="text" name="umur" class="form-control" value="{{ old('umur') }}" required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="form-label col-sm-2">ACTUAL(g)</label>
                            <div class="col-sm-4">
                                <input type="number" name="bw_act" class="form-control" value="{{ old('bw_act') }}" required>
                            </div>
                            
                            <label class="form-label col-sm-2">STANDAR(g)</label>
                            <div class="col-sm-4">
                                <input type="number" name="bw_std" class="form-control" value="{{ old('bw_std') }}" required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="form-label col-sm-2">DIFFERENT(g)</label>
                            <div class="col-sm-4">
                                <input type="number" name="dif_bw" class="form-control" value="{{ old('dif_bw') }}" required>
                            </div>

                            <label class="form-label col-sm-2">KETERANGAN</label>
                            <div class="col-sm-4">
                                <select name="keterangan" class="form-control" required>
                                    <option value="">-- Pilih Keterangan --</option>
                                    <option value="KURANG BAIK" {{ old('keterangan') == 'KURANG BAIK' ? 'selected' : '' }}>KURANG BAIK</option>
                                    <option value="BAIK" {{ old('keterangan') == 'BAIK' ? 'selected' : '' }}>BAIK</option>
                                    <option value="SANGAT BAIK" {{ old('keterangan') == 'SANGAT BAIK' ? 'selected' : '' }}>SANGAT BAIK</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info" id="simpan">SIMPAN</button>
                            <a href="{{ route('bw.index') }}" class="btn btn-danger">BATAL</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
