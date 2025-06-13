@extends('adminlte::page')

@section('title', 'Data Bibit')

@section('content_header')
    <h1 class="m-0 text-dark">Data Bibit</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Tambah Data Bibit</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('transaksiBibit.store') }}" method="post">
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

                             <label class="col-sm-1 col-form-label">JENIS BIBIT</label>
                            <div class="col-sm-2">
                                <select name="jenis_bibit" id="jenis_bibit" class="form-control" required>
                                    <option value="" selected disabled>-- Pilih Jenis Bibit --</option>
                                    <option value="CP707">CP707</option>
                                    <option value="MB202">MB202</option>
                                    <option value="AT811">AT811</option>
                                    {{-- <option value="TES 3">TES 3</option> --}}
                                </select>
                            </div>

                            <label class="col-sm-1 col-form-label">JUMLAH BIBIT</label>
                            <div class="col-sm-2">
                                <input type="number" name="jumlah_bibit" class="form-control"
                                    value="{{ old('jumlah_bibit') }}" required>
                            </div>
                            {{-- </div> --}}

                            {{-- <div class="form-group row mb-3"> --}}
                            <label class="col-sm-1 col-form-label">HARGA BIBIT</label>
                            <div class="col-sm-2">
                                <input type="number" name="harga_bibit" class="form-control"
                                    value="{{ old('harga_bibit') }}" required>
                            </div>
                            <label class="col-sm-1 col-form-label">TOTAL HARGA</label>
                            <div class="col-sm-2">
                                <input type="number" name="total_harga" class="form-control"
                                    value="{{ old('total_harga') }}" id="total_harga" readonly required>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info" id="simpan">SIMPAN</button>
                            <a href="{{ route('transaksiBibit.index') }}" class="btn btn-danger">BATAL</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jumlahBibit = document.querySelector('input[name="jumlah_bibit"]');
            const hargaBibit = document.querySelector('input[name="harga_bibit"]');
            const totalHarga = document.getElementById('total_harga');

            function hitungTotal() {
                const jumlah = parseFloat(jumlahBibit.value) || 0;
                const harga = parseFloat(hargaBibit.value) || 0;
                totalHarga.value = jumlah * harga;
            }

            jumlahBibit.addEventListener('input', hitungTotal);
            hargaBibit.addEventListener('input', hitungTotal);
        });
    </script>
@stop
