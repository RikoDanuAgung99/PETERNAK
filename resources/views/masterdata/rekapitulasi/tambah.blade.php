@extends('adminlte::page')

@section('title', 'Data Rekapitulasi')

@section('content_header')
    <h1 class="m-0 text-dark">Data Rekapitulasi</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Tambah Data Rekapitulasi</strong></h2>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('rekapitulasi.create') }}" class="mb-2">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="tanggal_start">Tanggal Dari</label>
                                <input type="date" name="tanggal_start" id="tanggal_start" class="form-control"
                                    value="{{ request('tanggal_start') }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="tanggal_end">Sampai</label>
                                <input type="date" name="tanggal_end" id="tanggal_end" class="form-control"
                                    value="{{ request('tanggal_end') }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="kandang_id">Kandang</label>
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
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                            </div>
                        </div>
                    </form>

                    @if (request()->filled(['tanggal_start', 'tanggal_end', 'kandang_id']))
                        <form method="POST" action="{{ route('rekapitulasi.store') }}">
                            @csrf
                            <input type="hidden" name="kandang_id" value="{{ request('kandang_id') }}">
                            <input type="hidden" name="tanggal_start" value="{{ request('tanggal_start') }}">
                            <input type="hidden" name="tanggal_end" value="{{ request('tanggal_end') }}">

                            <div class="form-group row mb-2">
                                <label class="col-md-2 col-form-label">Jumlah Bibit Masuk</label>
                                <div class="col-md-1">
                                    <input type="number" name="jml_bibit" class="form-control" value="{{ $jml_bibit }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="form-group row mb-2 align-items-center">
                                <label class="col-md-2 col-form-label">Jumlah Kematian</label>
                                <div class="col-md-1">
                                    <input type="number" name="jml_kematian" class="form-control"
                                        value="{{ $jml_kematian }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-md-2 col-form-label">Sisa Ayam</label>
                                <div class="col-md-1">
                                    <input type="number" name="sisa_ayam" class="form-control" value="{{ $sisa_ayam }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-md-2 col-form-label">Deplesi %</label>
                                <div class="col-md-1">
                                    <input type="number" step="0.01" id="deplesi" name="deplesi" class="form-control"
                                        value="{{ $deplesi }}" readonly required>
                                </div>

                                <label class="col-md-2 col-form-label">STD</label>
                                <div class="col-md-1">
                                    <input type="number" step="0.01" id="std_deplesi" name="std_deplesi"
                                        class="form-control" value="{{ $std_deplesi }}">
                                </div>

                                <label class="col-md-2 col-form-label">DIFF</label>
                                <div class="col-md-1">
                                    <input type="number" step="0.01" id="diff_deplesi" name="diff_deplesi"
                                        class="form-control" value="{{ $diff_deplesi }}" readonly required>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-md-2 col-form-label">Total Panen</label>
                                <div class="col-md-1">
                                    <input type="number" name="total_panen" class="form-control"
                                        value="{{ $total_panen }}" readonly required>
                                </div>
                                <label class="col-md-2 col-form-label">Tonase Panen</label>
                                <div class="col-md-1">
                                    <input type="number" name="tonase_panen" class="form-control"
                                        value="{{ $tonase_panen }}" readonly required>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-md-2 col-form-label">Rata-rata Berat</label>
                                <div class="col-md-1">
                                    <input type="number" step="0.01" name="rata_rata" class="form-control"
                                        value="{{ $rata_rata }}" readonly required>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label class="col-md-2 col-form-label">Pakan (KG)</label>
                                <div class="col-md-1">
                                    <input type="number" step="0.01" id="pakan" name="pakan"
                                        class="form-control" value="{{ $pakan }}" readonly required>

                                </div>
                                <label class="col-md-2 col-form-label">STD</label>
                                <div class="col-md-1">
                                    <input type="number" step="0.01" id="std_pakan" name="std_pakan"
                                        class="form-control" value="{{ $std_pakan }}">
                                </div>

                                <label class="col-md-2 col-form-label">DIFF</label>
                                <div class="col-md-1">
                                    <input type="number" step="0.01" id="diff_pakan" name="diff_pakan"
                                        class="form-control" value="{{ $diff_pakan }}" readonly required>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-md-2 col-form-label">FCR</label>
                                <div class="col-md-1">
                                    <input type="number" step="0.0001" id="fcr" name="fcr"
                                        class="form-control" value="{{ $fcr }}" readonly required>

                                </div>
                                <label class="col-md-2 col-form-label">STD</label>
                                <div class="col-md-1">
                                    <input type="number" step="0.0001" id="std_fcr" name="std_fcr"
                                        class="form-control" value="{{ $std_fcr }}">
                                </div>

                                <label class="col-md-2 col-form-label">DIFF</label>
                                <div class="col-md-1">
                                    <input type="number" step="0.0001" id="diff_fcr" name="diff_fcr"
                                        class="form-control" value="{{ $diff_fcr }}" readonly required>

                                </div>
                            </div>

                            <div class="table-responsive mt-5">
                                <h5><strong>Transaksi Bibit</strong></h5>
                                <table class="table table-bordered table-striped" id="bibit">
                                    <thead>
                                        <tr>
                                            <th>NO.</th>
                                            <th>TANGGAL</th>
                                            <th>NO DOC</th>
                                            <th>JENIS BIBIT</th>
                                            <th>JUMLAH BIBIT</th>
                                            <th>HARGA BIBIT</th>
                                            <th>TOTAL HARGA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($stokBibit as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>{{ $item->no_doc }}</td>
                                                <td>{{ $item->jenis_bibit }}</td>
                                                <td>{{ $item->jumlah_bibit }}</td>
                                                <td>Rp. {{ $item->harga_bibit }}</td>
                                                <td>Rp.{{ $item->total_harga }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    @php
                                        $total_jumlah_bibit = $stokBibit->sum('jumlah_bibit');
                                        $total_harga_bibit = $stokBibit->sum('total_harga');
                                        $harga_bibit_avg =
                                            $total_jumlah_bibit > 0 ? $total_harga_bibit / $total_jumlah_bibit : 0;
                                    @endphp

                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-center">TOTAL</th>
                                            <th>{{ $total_jumlah_bibit }}</th>
                                            <th>Rp. {{ number_format($harga_bibit_avg, 2) }}</th>
                                            <th>Rp. {{ number_format($total_harga_bibit), 2 }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="table-responsive mt-5">
                                <h5><strong>Transaksi Pakan</strong></h5>
                                <table class="table table-bordered table-striped" id="pakan">
                                    <thead>
                                        <tr>
                                            <th>NO.</th>
                                            <th>TANGGAL</th>
                                            <th>NO DOC</th>
                                            <th>JENIS PAKAN</th>
                                            <th>JUMLAH PAKAN</th>
                                            <th>HARGA PAKAN</th>
                                            <th>TOTAL HARGA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($stokPakan as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>{{ $item->no_doc }}</td>
                                                <td>{{ $item->jenis_pakan }}</td>
                                                <td>{{ $item->jumlah_pakan }}</td>
                                                <td>Rp. {{ $item->harga_pakan }}</td>
                                                <td>Rp. {{ $item->total_harga }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    @php
                                        $total_jumlah_pakan = $stokPakan->sum('jumlah_pakan');
                                        $total_harga_pakan = $stokPakan->sum('total_harga');
                                        $harga_pakan_avg =
                                            $total_jumlah_pakan > 0 ? $total_harga_pakan / $total_jumlah_pakan : 0;
                                    @endphp
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-center">TOTAL</th>
                                            <th>{{ $total_jumlah_pakan }}</th>
                                            <th>Rp. {{ number_format($harga_pakan_avg, 2) }}</th>
                                            <th>Rp. {{ number_format($total_harga_pakan, 2) }}</th>
                                        </tr>
                                </table>
                            </div>

                            <div class="table-responsive mt-5">
                                <h5><strong>Transaksi Obat</strong></h5>
                                <table class="table table-bordered table-striped" id="obat">
                                    <thead>
                                        <tr>
                                            <th>NO.</th>
                                            <th>TANGGAL</th>
                                            <th>JENIS OBAT</th>
                                            <th>JUMLAH OBAT</th>
                                            <th>HARGA OBAT</th>
                                            <th>TOTAL HARGA</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($stokObat as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>{{ $item->jenis_obat }}</td>
                                                <td>{{ $item->jumlah_obat }}</td>
                                                <td>Rp. {{ $item->harga_obat }}</td>
                                                <td>Rp. {{ $item->total_harga }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    @php
                                        $total_jumlah_obat = $stokObat->sum('jumlah_obat');
                                        $total_harga_obat = $stokObat->sum('total_harga');
                                        $harga_obat_avg =
                                            $total_jumlah_obat > 0 ? $total_harga_obat / $total_jumlah_obat : 0;
                                    @endphp
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-center">TOTAL</th>
                                            <th>{{ $total_jumlah_obat }}</th>
                                            <th> Rp. {{ number_format($harga_obat_avg, 2) }}</th>
                                            <th> Rp. {{ number_format($total_harga_obat, 2) }}</th>
                                        </tr>
                                </table>
                            </div>


                            <div class="table-responsive mt-5">
                                <h5><strong>Transaksi Panen</strong></h5>
                                <table class="table table-bordered table-striped" id="panen">
                                    <thead>
                                        <tr>
                                            <th>NO.</th>
                                            <th>TANGGAL</th>
                                            <th>NO DOC</th>
                                            <th>JUMLAH PANEN</th>
                                            <th>TONASE PANEN</th>
                                            <th>RATA RATA</th>
                                            <th>HARGA KONTRAK</th>
                                            <th>TOTAL HARGA</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($panen as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>{{ $item->no_doc }}</td>
                                                <td>{{ $item->jumlah_panen }}</td>
                                                <td>{{ $item->tonase_panen }}</td>
                                                <td>{{ $item->rata_rata }} KG</td>
                                                <td>Rp. {{ $item->harga_kontrak }}</td>
                                                <td>Rp. {{ $item->total_harga }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                    @php
                                        $total_jumlah_panen = $panen->sum('jumlah_panen');
                                        $total_tonase_panen = $panen->sum('tonase_panen');
                                        $total_harga_panen = $panen->sum('total_harga');

                                        $rata_rata_avg =
                                            $total_jumlah_panen > 0 ? $total_tonase_panen / $total_jumlah_panen : 0;
                                        $harga_kontrak_avg =
                                            $total_tonase_panen > 0 ? $total_harga_panen / $total_tonase_panen : 0;
                                    @endphp

                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-center">TOTAL</th>
                                            <th>{{ $total_jumlah_panen }}</th>
                                            <th>{{ $total_tonase_panen }}</th>
                                            <th>{{ number_format($rata_rata_avg, 2) }} KG</th>
                                            <th>Rp. {{ number_format($harga_kontrak_avg, 2) }}</th>
                                            <th>Rp. {{ number_format($total_harga_panen, 2) }}</th>
                                        </tr>
                                </table>
                            </div>
                            <div class="table-responsive mt-5">
                                <h5><strong>Transaksi Panen</strong></h5>
                                <table class="table table-bordered table-striped" id="panen">
                                    <thead>
                                        <tr>
                                            <th>NO.</th>
                                            <th>PENJUALAN</th>
                                            <th>PEMBELIAN</th>
                                            <th>KEUNTUNGAN/KERUGIAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                    <tbody>
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>Rp. {{ number_format($total_harga_panen, 2) }}</td>
                                            <td>Rp. {{ number_format($total_harga_bibit, 2) }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td></td>
                                            <td>Rp. {{ number_format($total_harga_pakan, 2) }}</td>
                                            <td></td>

                                        </tr>

                                        <tr>
                                            <td>{{ $no++ }} </td>
                                            <td></td>
                                            <td>Rp. {{ number_format($total_harga_obat, 2) }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Total</strong></td>
                                            <td><strong>Rp.
                                                    {{ number_format($total_harga_panen) }}</strong>
                                            </td>
                                            <td><strong>Rp.
                                                    {{ number_format($total_harga_bibit + $total_harga_pakan + $total_harga_obat, 2) }}</strong>
                                            </td>
                                            <td>
                                                <strong>Rp.
                                                    {{ number_format($total_harga_panen - ($total_harga_bibit + $total_harga_pakan + $total_harga_obat), 2) }}</strong>
                                            </td>
                                        </tr>

                                    </tbody>
                                    {{-- @endforeach --}}
                                    </tbody>

                                </table>
                            </div>



                            <input type="hidden" name="total_jumlah_bibit" value="{{ $total_jumlah_bibit }}">
                            <input type="hidden" name="harga_bibit_avg" value="{{ $harga_bibit_avg }}">
                            <input type="hidden" name="total_harga_bibit" value="{{ $total_harga_bibit }}">

                            <input type="hidden" name="total_jumlah_pakan" value="{{ $total_jumlah_pakan }}">
                            <input type="hidden" name="harga_pakan_avg" value="{{ $harga_pakan_avg }}">
                            <input type="hidden" name="total_harga_pakan" value="{{ $total_harga_pakan }}">

                            <input type="hidden" name="total_jumlah_obat" value="{{ $total_jumlah_obat }}">
                            <input type="hidden" name="harga_obat_avg" value="{{ $harga_obat_avg }}">
                            <input type="hidden" name="total_harga_obat" value="{{ $total_harga_obat }}">

                            <input type="hidden" name="total_jumlah_panen" value="{{ $total_jumlah_panen }}">
                            <input type="hidden" name="total_tonase_panen" value="{{ $total_tonase_panen }}">
                            <input type="hidden" name="rata_rata_avg" value="{{ $rata_rata_avg }}">
                            <input type="hidden" name="harga_kontrak_avg" value="{{ $harga_kontrak_avg }}">
                            <input type="hidden" name="total_harga_panen" value="{{ $total_harga_panen }}">

                            <input type="hidden" name="penjualan" value="{{ $total_harga_panen }}">
                            <input type="hidden" name="pembelian"
                                value="{{ $total_harga_bibit + $total_harga_pakan + $total_harga_obat }}">
                            <input type="hidden" name="keuntungan_kerugian"
                                value="{{ $total_harga_panen - ($total_harga_bibit + $total_harga_pakan + $total_harga_obat) }}">



                            <button type="submit" class="btn btn-success mt-2">Simpan Rekapitulasi</button>
                        </form>
                    @endif

                </div>

            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stdInput = document.getElementById('std_deplesi');
            const deplesiInput = document.getElementById('deplesi');
            const diffInput = document.getElementById('diff_deplesi');

            function updateDiff1() {
                const std = parseFloat(stdInput.value) || 0;
                const deplesi = parseFloat(deplesiInput.value) || 0;
                const diff = std - deplesi;
                diffInput.value = diff.toFixed(2);
            }

            stdInput.addEventListener('input', updateDiff1);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stdInput = document.getElementById('std_pakan');
            const pakanInput = document.getElementById('pakan');
            const diffInput = document.getElementById('diff_pakan');

            function updateDiff() {
                const std = parseFloat(stdInput.value) || 0;
                const pakan = parseFloat(pakanInput.value) || 0;
                const diff = std - pakan;
                diffInput.value = diff.toFixed(2);
            }

            stdInput.addEventListener('input', updateDiff);
            updateDiff();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stdInput = document.getElementById('std_fcr');
            const fcrInput = document.getElementById('fcr');
            const diffInput = document.getElementById('diff_fcr');

            function updateDiff() {
                const std = parseFloat(stdInput.value) || 0;
                const fcr = parseFloat(fcrInput.value) || 0;
                const diff = std - fcr;
                diffInput.value = diff.toFixed(4);
            }

            stdInput.addEventListener('input', updateDiff);
            updateDiff();
        });
    </script>
@stop
