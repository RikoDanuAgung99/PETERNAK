@extends('adminlte::page')

@section('title', 'Edit Data Panen')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Panen</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Edit Data Panen</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('panen.update', $panen->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group row mb-3">
                            <label class="col-sm-1 col-form-label">TANGGAL</label>
                            <div class="col-sm-3">
                                <input type="date" name="tanggal" class="form-control"
                                    value="{{ old('tanggal', $panen->tanggal) }}" required>
                            </div>

                            <label class="col-sm-1 col-form-label">KANDANG</label>
                            <div class="col-sm-3">
                                <select name="kandang_id" id="kandang_id" class="form-control" required>
                                    <option value="">-- Pilih Kandang --</option>
                                    @foreach ($kandang as $item)
                                        <option value="{{ $item->id }}"
                                            {{ (isset($bibit) && $bibit->kandang_id == $item->id) || old('kandang_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <label class="col-sm-1 col-form-label">NO DOC</label>
                            <div class="col-sm-3">
                                <input type="text" name="no_doc" class="form-control"
                                    value="{{ old('no_doc', $panen->no_doc) }}" required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-sm-1 col-form-label">JUMLAH PANEN</label>
                            <div class="col-sm-3">
                                <input type="number" name="jumlah_panen" class="form-control" id="jumlah_panen"
                                    value="{{ old('jumlah_panen', $panen->jumlah_panen) }}" required>
                            </div>

                            <label class="col-sm-1 col-form-label">TONASE PANEN</label>
                            <div class="col-sm-3">
                                <input type="number" name="tonase_panen" class="form-control" id="tonase_panen"
                                    value="{{ old('tonase_panen', $panen->tonase_panen) }}" required>
                            </div>

                            <label class="col-sm-1 col-form-label">RATA RATA</label>
                            <div class="col-sm-3">
                                <input type="number" step="0.01" name="rata_rata" class="form-control" id="rata_rata"
                                    value="{{ old('rata_rata', $panen->rata_rata) }}" readonly required>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-sm-1 col-form-label">HARGA KONTRAK</label>
                            <div class="col-sm-3">
                                <input type="number" name="harga_kontrak" class="form-control" id="harga_kontrak"
                                    value="{{ old('harga_kontrak', $panen->harga_kontrak) }}" readonly required>
                            </div>

                            <label class="col-sm-2 col-form-label">TOTAL HARGA</label>
                            <div class="col-sm-4">
                                <input type="number" name="total_harga" class="form-control"
                                    value="{{ old('total_harga', $panen->total_harga) }}" id="total_harga" readonly
                                    required>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info" id="simpan">UPDATE</button>
                            <a href="{{ route('panen.index') }}" class="btn btn-danger">BATAL</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jumlahPanen = document.getElementById('jumlah_panen');
            const tonasePanen = document.getElementById('tonase_panen');
            const rataRata = document.getElementById('rata_rata');
            const hargaKontrak = document.getElementById('harga_kontrak');
            const totalHarga = document.getElementById('total_harga');

            function hitungSemuanya() {
                const jumlah = parseFloat(jumlahPanen.value) || 0;
                const tonase = parseFloat(tonasePanen.value) || 0;

                if (jumlah > 0 && tonase > 0) {
                    const rata = tonase / jumlah;
                    rataRata.value = rata.toFixed(2);

                    let harga = 0;
                    if (rata >= 2.0) {
                        harga = 23350;
                    } else if (rata >= 1.9) {
                        harga = 23400;
                    } else if (rata >= 1.8) {
                        harga = 23500;
                    } else if (rata >= 1.7) {
                        harga = 23600;
                    } else if (rata >= 1.6) {
                        harga = 23600;
                    } else if (rata >= 1.5) {
                        harga = 23700;
                    } else if (rata >= 1.4) {
                        harga = 23800;
                    } else if (rata >= 1.3) {
                        harga = 23950;
                    } else if (rata >= 1.2) {
                        harga = 24100;
                    } else if (rata >= 1.1) {
                        harga = 24200;
                    } else if (rata >= 1.0) {
                        harga = 24300;
                    }

                    hargaKontrak.value = harga;
                    totalHarga.value = Math.round(tonase * harga);
                } else {
                    rataRata.value = '';
                    hargaKontrak.value = '';
                    totalHarga.value = '';
                }
            }

            jumlahPanen.addEventListener('input', hitungSemuanya);
            tonasePanen.addEventListener('input', hitungSemuanya);
            hitungSemuanya();
        });
    </script>
@stop
