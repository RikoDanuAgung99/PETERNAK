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
                    <h3 class="card-title"><strong>Edit Data Pakan</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('transaksiPakan.update', $pakan->id) }}" method="post">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label">TANGGAL</label>
                            <div class="col-sm-2">
                                <input type="date" name="tanggal" class="form-control"
                                    value="{{ isset($pakan) ? $pakan->tanggal : old('tanggal') }}" required>
                            </div>
                            <label class="col-sm-1 col-form-label">KANDANG</label>
                            <div class="col-sm-2">
                                <select name="kandang_id" id="kandang_id" class="form-control" required>
                                    <option value="">-- Pilih Kandang --</option>
                                    @foreach ($kandang as $item)
                                        <option value="{{ $item->id }}"
                                            {{ (isset($pakan) ? $pakan->kandang_id : old('kandang_id')) == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-sm-1 col-form-label">DOC NO</label>
                            <div class="col-sm-2">
                                <input type="text" name="no_doc" class="form-control"
                                    value="{{ isset($pakan) ? $pakan->no_doc : old('no_doc') }}" required>
                            </div>

                        </div>

                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label">JENIS PAKAN</label>
                            <div class="col-sm-2">
                                <select name="jenis_pakan" class="form-control" required>
                                    <option value=""
                                        {{ (isset($pakan) ? $pakan->jenis_pakan : old('jenis_pakan')) == '' ? 'selected' : '' }}
                                        disabled>-- Pilih Jenis Pakan --</option>
                                    <option value="STARTER" {{ $pakan->jenis_pakan == 'STARTER' ? 'selected' : '' }}>
                                        STARTER</option>
                                    <option value="PRESTARTER" {{ $pakan->jenis_pakan == 'PRESTARTER' ? 'selected' : '' }}>
                                        PRESTARTER
                                    </option>
                                    <option value="FINISHER" {{ $pakan->jenis_pakan == 'FINISHER' ? 'selected' : '' }}>
                                        FINISHER
                                    </option>
                                </select>
                            </div>
                            <label class="col-sm-1 col-form-label">JUMLAH PAKAN</label>
                            <div class="col-sm-2">
                                <input type="number" name="jumlah_pakan" class="form-control"
                                    value="{{ isset($pakan) ? $pakan->jumlah_pakan : old('jumlah_pakan') }}" required>
                            </div>
                            <label class="col-sm-1 col-form-label">HARGA PAKAN</label>
                            <div class="col-sm-2">
                                <input type="number" name="harga_pakan" class="form-control" id="harga_pakan"
                                    value="{{ isset($pakan) ? $pakan->harga_pakan : old('harga_pakan') }}">
                            </div>
                            <label class="col-sm-1 col-form-label">TOTAL HARGA</label>
                            <div class="col-sm-2">
                                <input type="number" name="total_harga" class="form-control"
                                    value="{{ isset($pakan) ? $pakan->total_harga : old('total_harga') }}"
                                    id="total_harga" required readonly>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info" id="simpan">SIMPAN</button>
                            <a href="{{ route('transaksiPakan.index') }}" class="btn btn-danger">BATAL</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jumlahPakan = document.querySelector('input[name="jumlah_pakan"]');
            const hargaPakan = document.querySelector('input[name="harga_pakan"]');
            const totalHarga = document.getElementById('total_harga');

            function hitungTotal() {
                const jumlah = parseFloat(jumlahPakan.value) || 0;
                const harga = parseFloat(hargaPakan.value) || 0;
                totalHarga.value = jumlah * harga;
            }

            jumlahPakan.addEventListener('input', hitungTotal);
            hargaPakan.addEventListener('input', hitungTotal);
        });
    </script>
@stop
