@extends('adminlte::page')

@section('title', 'Data Obat')

@section('content_header')
    <h1 class="m-0 text-dark">Data Obat</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Tambah Data Penggunaan Obat</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('obat.store') }}" method="post">
                        @csrf

                        <div class="form-group row mb-3">
                            <label class="col-sm-1 col-form-label">TANGGAL</label>
                            <div class="col-sm-3">
                                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}"
                                    required>
                            </div>

                            <label class="col-sm-2 col-form-label">JENIS OBAT</label>
                            <div class="col-sm-2">
                                <select name="jenis" id="jenis" class="form-control" required>
                                    <option value="" selected disabled>-- Pilih Jenis Obat --</option>
                                    <option value="ANTIBIOTIK">ANTIBIOTIK</option>
                                    <option value="PROBIOTIK">PROBIOTIK</option>
                                    <option value="VITAMIN">VITAMIN</option>
                                </select>
                            </div>
                            <label class="col-sm-1 col-form-label">STOK OBAT</label>
                            <div class="col-sm-2">
                                <input type="number" name="stok_obat" class="form-control"
                                    value="{{ old('stok_obat') ?? 0 }}" required readonly id="stok_obat">
                            </div>

                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-sm-1 col-form-label">UMUR (HARI)</label>
                            <div class="col-sm-3">
                                <input type="text" name="umur" class="form-control" value="{{ old('umur') }}"
                                    required>
                            </div>

                            <label class="col-sm-2 col-form-label">JUMLAH OBAT (BUNGKUS@100g)</label>
                            <div class="col-sm-2">
                                <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah') }}"
                                    required>
                            </div>
                        </div>



                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info" id="simpan">SIMPAN</button>
                            <a href="{{ route('obat.index') }}" class="btn btn-danger">BATAL</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const stokObat = @json($stokObat);

        const jenisSelect = document.getElementById('jenis');
        const stokInput = document.getElementById('stok_obat');

        window.addEventListener('DOMContentLoaded', () => {
            const jenisTerpilih = jenisSelect.value;
            if (jenisTerpilih && stokObat[jenisTerpilih]) {
                stokInput.value = stokObat[jenisTerpilih];
            } else {
                stokInput.value = 0;
            }
        });

        jenisSelect.addEventListener('change', function() {
            const jenis = this.value;
            if (jenis && stokObat[jenis]) {
                stokInput.value = stokObat[jenis];
            } else {
                stokInput.value = 0;
            }
        });
    </script>

@stop
