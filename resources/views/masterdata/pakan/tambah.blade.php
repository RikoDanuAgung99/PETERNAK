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
                    <h3 class="card-title"><strong>TAMBAH DATA PENGGUNAAN PAKAN</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('pakan.store') }}" method="post">
                        @csrf
                        <div class="form-group row mb-3">
                            <label class="form-label col-sm-1 col-form-label">TANGGAL</label>
                            <div class="col-sm-3">
                                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}"
                                    required>
                            </div>

                            <label for="jenis" class="form-label col-sm-2 col-form-label">JENIS PAKAN</label>
                            <div class="col-sm-2">
                                <select name="jenis" id="jenis" class="form-control" required>
                                    <option value="" selected disabled>-- Pilih Jenis Pakan --</option>
                                    <option value="STARTER">STARTER</option>
                                    <option value="PRESTARTER">PRESTARTER</option>
                                    <option value="FINISHER">FINISHER</option>
                                </select>
                            </div>
                            <label class="col-sm-1 col-form-label">STOK PAKAN</label>
                            <div class="col-sm-2">
                                <input type="number" name="stok_pakan" class="form-control"
                                    value="{{ old('stok_pakan') ?? 0 }}" required readonly id="stok_pakan">
                            </div>
                        </div>


                        <div class="form-group row mb-3">
                            <label class="form-label col-sm-1 col-form-label">UMUR (HARI)</label>
                            <div class="col-sm-3">
                                <input type="text" name="umur" class="form-control" value="{{ old('umur') }}"
                                    required>
                            </div>

                            <label class="form-label col-sm-2 col-form-label">JUMLAH PAKAN (SAK)</label>
                            <div class="col-sm-2">
                                <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah') }}"
                                    required>
                            </div>
                        </div>



                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info" id="simpan">SIMPAN</button>
                            <a href="{{ route('pakan.index') }}" class="btn btn-danger">BATAL</a>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                const stokPakan = @json($stokPakan);

                const jenisSelect = document.getElementById('jenis');
                const stokInput = document.getElementById('stok_pakan');

                window.addEventListener('DOMContentLoaded', () => {
                    const jenisTerpilih = jenisSelect.value;
                    if (jenisTerpilih && stokPakan[jenisTerpilih]) {
                        stokInput.value = stokPakan[jenisTerpilih];
                    } else {
                        stokInput.value = 0;
                    }
                });

                jenisSelect.addEventListener('change', function() {
                    const jenis = this.value;
                    if (jenis && stokPakan[jenis]) {
                        stokInput.value = stokPakan[jenis];
                    } else {
                        stokInput.value = 0;
                    }
                });
            </script>
        @stop
