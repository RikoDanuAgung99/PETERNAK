@extends('adminlte::page')

@section('title', 'Data Obat')

@section('content_header')
    <h1 class="m-0 text-dark">DATA TRANSAKSI OBAT</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>EDIT DATA TRANSAKSI OBAT</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('transaksiObat.update', $obat->id) }}" method="post">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label">TANGGAL</label>
                            <div class="col-sm-3">
                                <input type="date" name="tanggal" class="form-control"
                                    value="{{ isset($obat) ? $obat->tanggal : old('tanggal') }}" required>
                            </div>

                            <label class="col-sm-1 col-form-label">KANDANG</label>
                            <div class="col-sm-3">
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
                            <label class="col-sm-1 col-form-label">JENIS OBAT</label>
                            <div class="col-sm-3">
                                <select name="jenis_obat" class="form-control" required>
                                    <option value=""
                                        {{ (isset($obat) ? $obat->jenis_obat : old('jenis_obat')) == '' ? 'selected' : '' }}
                                        disabled>-- Pilih Jenis Obat --</option>
                                    <option value="ANTIBIOTIK" {{ $obat->jenis_obat == 'ANTIBIOTIK' ? 'selected' : '' }}>
                                        ANTIBIOTIK</option>
                                    <option value="PROBIOTIK" {{ $obat->jenis_obat == 'PROBIOTIK' ? 'selected' : '' }}>
                                        PROBIOTIK
                                    </option>
                                    <option value="VITAMIN" {{ $obat->jenis_obat == 'VITAMIN' ? 'selected' : '' }}>VITAMIN
                                    </option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">


                            <label class="col-sm-1 col-form-label">JUMLAH OBAT (BUNGKUS/100g)</label>
                            <div class="col-sm-3">
                                <input type="number" name="jumlah_obat" class="form-control"
                                    value="{{ isset($obat) ? $obat->jumlah_obat : old('jumlah_obat') }}">
                            </div>
                            <label class="col-sm-1 col-form-label">HARGA OBAT</label>
                            <div class="col-sm-2">
                                <input type="number" name="harga_obat" class="form-control" id="harga_obat"
                                    value="{{ isset($obat) ? $obat->harga_obat : old('harga_obat') }}" required>
                            </div>
                            <label class="col-sm-1 col-form-label">TOTAL HARGA</label>
                            <div class="col-sm-1">
                                <input type="number" name="total_harga" class="form-control"
                                    value="{{ isset($obat) ? $obat->total_harga : old('total_harga') }}" id="total_harga"
                                    required readonly>
                            </div>


                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info" id="simpan">SIMPAN</button>
                            <a href="{{ route('transaksiObat.index') }}" class="btn btn-danger">BATAL</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jumlahObat = document.querySelector('input[name="jumlah_obat"]');
            const hargaObat = document.querySelector('input[name="harga_obat"]');
            const totalHarga = document.getElementById('total_harga');

            function hitungTotal() {
                const jumlah = parseFloat(jumlahObat.value) || 0;
                const harga = parseFloat(hargaObat.value) || 0;
                totalHarga.value = jumlah * harga;
            }

            jumlahObat.addEventListener('input', hitungTotal);
            hargaObat.addEventListener('input', hitungTotal);
        });
    </script>
@stop
