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
                    <h3 class="card-title"><strong>Edit Data Penggunaan Pakan</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('pakan.update', $pakan->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="form-group row mb-3">
                            <label class="form-label col-sm-1 col-form-label">TANGGAL</label>
                            <div class="col-sm-3">
                                <input type="date" name="tanggal" class="form-control"
                                    value="{{ isset($pakan) ? $pakan->tanggal : old('pakan') }}" required>
                            </div>
                            <label class="form-label col-sm-1">JENIS PAKAN</label>
                            <div class="col-sm-3">
                                <select name="jenis" class="form-control" required disabled>
                                    <option value="" selected disabled>-- Pilih Jenis Pakan --
                                    </option>
                                    <option value="STARTER" {{ $pakan->jenis == 'STARTER' ? 'selected' : '' }}>STARTER
                                    </option>
                                    <option value="PRESTARTER" {{ $pakan->jenis == 'PRESTARTER' ? 'selected' : '' }}>
                                        PRESTARTER</option>
                                    <option value="FINISHER" {{ $pakan->jenis == 'FINISHER' ? 'selected' : '' }}>FINISHER
                                    </option>
                                </select>
                            </div>
                            <label class="col-sm-1 col-form-label">STOK PAKAN</label>
                            <div class="col-sm-2">
                                <input type="number" name="stok_pakan" class="form-control"
                                    value="{{ $stokPakan[$pakan->jenis] }}" readonly required id="stok_pakan">
                            </div>
                        </div>

                        <div class="form-group row mb-3">

                            <label class="form-label col-sm-1 col-form-label">UMUR (HARI)</label>
                            <div class="col-sm-3">
                                <input type="text" name="umur" class="form-control"
                                    value="{{ isset($pakan) ? $pakan->umur : old('pakan') }}" required>
                            </div>
                            {{-- <div class="form-group row mb-3"> --}}
                            <label class="form-label col-sm-1 col-form-label">JUMLAH PAKAN</label>
                            <div class="col-sm-3">
                                <input type="number" name="jumlah" class="form-control"
                                    value="{{ isset($pakan) ? $pakan->jumlah : old('pakan') }}" required>
                            </div>
                            {{-- </div> --}}
                        </div>



                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info" id="simpan">SIMPAN</button>
                            <a href="{{ route('pakan.index') }}" class="btn btn-danger">BATAL</a>
                        </div>
                    </form>
                </div>
            </div>
        @section('scripts')
            <script>
                const stokPakan = @json($stokPakan);
                const jenisSelect = document.getElementById('jenis');
                const stokInput = document.getElementById('stok_pakan');

                function updateStokInput() {
                    const jenis = jenisSelect.value;
                    stokInput.value = stokPakan[jenis] ?? 0;
                }

                window.addEventListener('DOMContentLoaded', updateStokInput);
                jenisSelect.addEventListener('change', updateStokInput);
            </script>
        @endsection
    @stop
