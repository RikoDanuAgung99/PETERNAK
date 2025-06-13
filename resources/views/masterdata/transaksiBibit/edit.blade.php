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
                    <h3 class="card-title"><strong>Edit Data Penggunaan Bibit</strong></h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('transaksiBibit.update', $bibit->id) }}" method="post">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label">TANGGAL</label>
                            <div class="col-sm-2">
                                <input type="date" name="tanggal" class="form-control"
                                    value="{{ isset($bibit) ? $bibit->tanggal : old('tanggal') }}" required>
                            </div>

                            <label class="col-sm-1 col-form-label">KANDANG</label>
                            <div class="col-sm-2">
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
                            <div class="col-sm-2">
                                <input type="text" name="no_doc" class="form-control"
                                    value="{{ isset($bibit) ? $bibit->no_doc : old('no_doc') }}" required>
                            </div>                         
                        </div>

                        <div class="form-group row">
                             <label class="col-sm-1 col-form-label">JENIS OBAT</label>
                            <div class="col-sm-2">
                                <select name="jenis_bibit" class="form-control" required>
                                    <option value=""
                                        {{ (isset($bibit) ? $bibit->jenis_bibit : old('jenis_bibit')) == '' ? 'selected' : '' }}
                                        disabled>-- Pilih Jenis Obat --</option>
                                    <option value="CP707" {{ $bibit->jenis_bibit == 'CP707' ? 'selected' : '' }}>
                                        CP707</option>
                                    <option value="MB202" {{ $bibit->jenis_bibit == 'MB202' ? 'selected' : '' }}>MB202
                                    </option>
                                    <option value="AT811" {{ $bibit->jenis_bibit == 'AT811' ? 'selected' : '' }}>AT811
                                    </option>
                                </select>
                            </div>
                            <label class="col-sm-1 col-form-label">JUMLAH BIBIT</label>
                            <div class="col-sm-2">
                                <input type="text" name="jumlah_bibit" class="form-control"
                                    value="{{ isset($bibit) ? $bibit->jumlah_bibit : old('jumlah_bibit') }}" required>
                            </div>
                            {{-- </div> --}}

                            {{-- <div class="form-group row"> --}}
                            <label class="col-sm-1 col-form-label">HARGA BIBIT</label>
                            <div class="col-sm-2">
                                <input type="number" name="harga_bibit" class="form-control"
                                    value="{{ isset($bibit) ? $bibit->harga_bibit : old('harga_bibit') }}">
                            </div>
                            <label class="col-sm-1 col-form-label">TOTAL HARGA</label>
                            <div class="col-sm-2">
                                <input type="number" name="total_harga" class="form-control"
                                    value="{{ isset($bibit) ? $bibit->total_harga : old('total_harga') }}" readonly
                                    required>
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
            const hargaBibitInput = document.querySelector('input[name="harga_bibit"]');
            const jumlahBibitInput = document.querySelector('input[name="jumlah_bibit"]');
            const totalHargaInput = document.querySelector('input[name="total_harga"]');

            function updateTotalHarga() {
                const hargaBibit = parseFloat(hargaBibitInput.value) || 0;
                const jumlahBibit = parseFloat(jumlahBibitInput.value) || 0;
                totalHargaInput.value = hargaBibit * jumlahBibit;
            }

            hargaBibitInput.addEventListener('input', updateTotalHarga);
            jumlahBibitInput.addEventListener('input', updateTotalHarga);
        });
    @stop
