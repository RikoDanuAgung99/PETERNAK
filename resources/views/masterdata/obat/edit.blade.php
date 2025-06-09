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
                    <h3 class="card-title"><strong>Edit Data Penggunaan Obat</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('obat.update', $obat->id) }}" method="post">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label">TANGGAL</label>
                            <div class="col-sm-3">
                                <input type="date" name="tanggal" class="form-control"
                                    value="{{ isset($obat) ? $obat->tanggal : old('tanggal') }}" required>
                            </div>

                            <label class="col-sm-2 col-form-label">JENIS OBAT</label>
                            <div class="col-sm-2">
                                <select name="jenis" class="form-control" required disabled>
                                    <option value="" selected disabled>-- Pilih Jenis Obat --</option>
                                    <option value="ANTIBIOTIK" {{ $obat->jenis == 'ANTIBIOTIK' ? 'selected' : '' }}>
                                        ANTIBIOTIK</option>
                                    <option value="PROBIOTIK" {{ $obat->jenis == 'PROBIOTIK' ? 'selected' : '' }}>PROBIOTIK
                                    </option>
                                    <option value="VITAMIN" {{ $obat->jenis == 'VITAMIN' ? 'selected' : '' }}>VITAMIN
                                    </option>
                                </select>
                            </div>
                            <label class="col-sm-1 col-form-label">STOK OBAT</label>
                            <div class="col-sm-2">
                                <input type="number" name="stok_obat" class="form-control"
                                    value="{{ $stokObat[$obat->jenis] }}" readonly required id="stok_obat">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label">UMUR (HARI)</label>
                            <div class="col-sm-3">
                                <input type="number" name="umur" class="form-control"
                                    value="{{ isset($obat) ? $obat->umur : old('umur') }}" required>
                            </div>
                            <label class="col-sm-2 col-form-label">JUMLAH OBAT (BUNGKUS/100g)</label>
                            <div class="col-sm-2">
                                <input type="number" name="jumlah" class="form-control"
                                    value="{{ isset($obat) ? $obat->jumlah : old('jumlah') }}" required>
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
@section('scripts')
    <script>
        const stokObat = @json($stokObat);
        const jenisSelect = document.getElementById('jenis');
        const stokInput = document.getElementById('stok_obat');

        function updateStokInput() {
            const jenis = jenisSelect.value;
            stokInput.value = stokObat[jenis] ?? 0;
        }

        window.addEventListener('DOMContentLoaded', updateStokInput);
        jenisSelect.addEventListener('change', updateStokInput);
    </script>
@endsection
@stop
