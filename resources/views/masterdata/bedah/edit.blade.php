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
                    <h3 class="card-title"><strong>EDIT DATA BEDAH</strong></h3>
                </div>
                {{-- <div class="card-body">
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

                        <div class="form-group mb-3">
                            <label for="images">Foto Lama</label><br>
                            @if ($bedah->images)
                                <img src="{{ asset('storage/bedah/' . $bedah->images) }}" width="200" alt="Foto Bedah">
                            @else
                                <p>Tidak ada foto</p>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="images">Ganti Foto</label>
                            <input type="file" name="images" class="form-control" accept="image/*">
                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info" id="simpan">SIMPAN</button>
                            <a href="{{ route('bedah.index') }}" class="btn btn-danger">BATAL</a>
                        </div>
                    </form>
                </div> --}}

                <div class="card-body">
                    <form action="{{ route('bedah.update', $bedah->id) }}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">TANGGAL</label>
                            <div class="col-sm-4">
                                <input type="date" name="tanggal" class="form-control"
                                    value="{{ old('tanggal', $bedah->tanggal) }}" required>
                            </div>

                            <label class="col-sm-2 col-form-label">UMUR (HARI)</label>
                            <div class="col-sm-4">
                                <input type="number" name="umur" class="form-control"
                                    value="{{ old('umur', $bedah->umur) }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">GEJALA</label>
                            <div class="col-sm-4">
                                <input type="text" name="gejala" class="form-control"
                                    value="{{ old('gejala', $bedah->gejala) }}" required>
                            </div>

                            <label class="col-sm-2 col-form-label">DIAGNOSIS</label>
                            <div class="col-sm-4">
                                <input type="text" name="diagnosis" class="form-control"
                                    value="{{ old('diagnosis', $bedah->diagnosis) }}" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="images">Foto Lama</label><br>
                            @if ($bedah->images)
                                <a href="{{ asset('storage/bedah/' . $bedah->images) }}" target="_blank">
                                    <img src="{{ asset('storage/bedah/' . $bedah->images) }}" width="200"
                                        alt="Foto Bedah">
                                </a>
                            @else
                                <p>Tidak ada foto</p>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="images">Ganti Foto</label>
                            <input type="file" name="images" class="form-control" accept="image/*">
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
