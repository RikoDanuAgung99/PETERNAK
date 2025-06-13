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
                    <h3 class="card-title"><strong>Tambah Data Pakan</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('transaksiPakan.store') }}" method="post">
                        @csrf

                        <div class="form-group row mb-3">
                            <label class="col-sm-1 col-form-label">TANGGAL</label>
                            <div class="col-sm-2">
                                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}"
                                    required>
                            </div>
                            <label class="col-sm-1 col-form-label">KANDANG</label>
                            <div class="col-sm-2">
                                <select name="kandang_id" id="kandang_id" class="form-control" required>
                                    <option value="">-- Pilih Kandang --</option>
                                    @foreach ($kandang as $item)
                                        <option value="{{ $item->id }}"
                                            {{ request('kandang_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <label class="col-sm-1 col-form-label">NO DOC</label>
                            <div class="col-sm-2">
                                <input type="text" name="no_doc" class="form-control" value="{{ old('no_doc') }}"
                                    required>
                            </div>

                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-sm-1 col-form-label">JENIS PAKAN</label>
                            <div class="col-sm-2">
                                <select name="jenis_pakan" id="jenis_pakan" class="form-control" required>
                                    <option value="" selected disabled>-- Pilih Jenis Pakan --</option>
                                    <option value="STARTER">STARTER</option>
                                    <option value="PRESTARTER">PRESTARTER</option>
                                    <option value="FINISHER">FINISHER</option>
                                </select>
                            </div>

                            <label class="col-sm-1 col-form-label">JUMLAH PAKAN (SAK)</label>
                            <div class="col-sm-2">
                                <input type="number" name="jumlah_pakan" class="form-control"
                                    value="{{ old('jumlah_pakan') }}" required>
                            </div>
                            {{-- </div> --}}
                            {{-- <div class="form-group row mb-3"> --}}
                            <label class="col-sm-1 col-form-label">HARGA PAKAN (SAK) </label>
                            <div class="col-sm-2">
                                <input type="number" name="harga_pakan" class="form-control"
                                    value="{{ old('harga_pakan') }}" required>
                            </div>
                            <label class="col-sm-1 col-form-label">TOTAL HARGA</label>
                            <div class="col-sm-2">
                                <input type="number" name="total_harga" class="form-control"
                                    value="{{ old('total_harga') }}" id="total_harga" readonly required>
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
