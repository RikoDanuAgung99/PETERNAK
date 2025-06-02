@extends('adminlte::page')

@section('title', 'Data Bobot')

@section('content_header')
    <h1 class="m-0 text-dark">Data Bobot</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Edit Data Bobot</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('bw.update', $bw->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">TANGGAL</label>
                            <div class="col-sm-4">
                                <input type="date" name="tanggal" class="form-control" value="{{ isset($bw) ? $bw->tanggal : old('tanggal') }}" required>
                            </div>

                            <label class="col-sm-2 col-form-label">UMUR (HARI)</label>
                            <div class="col-sm-4">
                                <input type="number" name="umur" class="form-control" value="{{ isset($bw) ? $bw->umur : old('umur') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">BOBOT ACTUAL (g)</label>
                            <div class="col-sm-4">
                                <input type="number" name="bw_act" class="form-control" value="{{ isset($bw) ? $bw->bw_act : old('bw_act') }}" required>
                            </div>

                            <label class="col-sm-2 col-form-label">BOBOT STANDAR (g)</label>
                            <div class="col-sm-4">
                                <input type="number" name="bw_std" class="form-control" value="{{ isset($bw) ? $bw->bw_std : old('bw_std') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">DIFFERENT BOBOT (g)</label>
                            <div class="col-sm-4">
                                <input type="number" name="dif_bw" class="form-control" value="{{ isset($bw) ? $bw->dif_bw : old('dif_bw') }}" required>
                            </div>
                            <label class="col-sm-2 col-form-label">KETERANGAN</label>
                            <div class="col-sm-4">
                                <select name="keterangan" class="form-control" required>
                                    <option value="">-- Pilih Keterangan --</option>
                                    <option value="KURANG BAIK " {{ (isset($bw) && $bw->keterangan == 'KURANG BAIK') ? 'selected' : (old('keterangan') == 'KURANG BAIK' ? 'selected' : '') }}>KURANG BAIK</option>
                                    <option value="BAIK" {{ (isset($bw) && $bw->keterangan == 'BAIK') ? 'selected' : (old('keterangan') == 'BAIK' ? 'selected' : '') }}>BAIK</option>
                                    <option value="SANGAT BAIK" {{ (isset($bw) && $bw->keterangan == 'SANGAT BAIK') ? 'selected' : (old('keterangan') == 'SANGAT BAIK' ? 'selected' : '') }}>SANGAT BAIK</option>
                                </select>
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
