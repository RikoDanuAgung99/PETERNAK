@extends('adminlte::page')

@section('title', 'Transaksi Rekapitulasi')

@section('plugins.Datatables', true)

{{-- @php
    $page = Request::get('page') ? Request::get('page') : 1;
    $no = ($page - 1) * $halaman + 1;
@endphp --}}

@section('content_header')
    <h1 class="m-0 text-dark">Data Rekapitulasi</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Table Data Rekapitulasi</strong></h2>
                    <div class="form-group float-right">
                        <a href="{{ route('print.rekapitulasi', $list->id) }}" target="_blank" class="btn btn-success btn-md"
                            id="print-rekapitulasi">
                            Print Rekapitulasi
                        </a>
                    </div>

                </div>
                <div class="card-body">
                    <table class="table table-borderless w-auto">
                        <tr>
                            <td><strong>BIBIT MASUK</strong></td>
                            <td><strong>{{ $list->jml_bibit }}</strong></td>
                            <td><strong> EKOR </strong></td>
                        </tr>

                        <tr>
                            <td><strong>DEPLESI</strong></td>
                            <td><strong>{{ $list->jml_kematian }}</strong></td>
                            <td><strong> EKOR </strong></td>
                        </tr>
                        <tr>
                            <td><strong>SISA AYAM</strong></td>
                            <td><strong>{{ $list->sisa_ayam }}</strong></td>
                            <td><strong> EKOR </strong></td>
                        </tr>

                        <tr>
                            <td><strong>DEPLESI (%)</strong></td>
                            <td><strong> {{ $list->deplesi }} </strong></td>
                            <td><strong> % </strong></td>
                            <td style="width: 50px;"></td>
                            <td><strong>STD</strong></td>
                            <td><strong>{{ $list->std_deplesi }}</strong></td>
                            <td><strong> % </strong></td>
                            <td style="width: 50px;"></td>
                            <td><strong>DIFF</strong></td>
                            <td><strong>{{ $list->diff_deplesi }}</strong></td>
                            <td><strong> % </strong></td>
                        </tr>

                        <tr>
                            <td><strong>TOTAL PANEN</strong></td>
                            <td><strong>{{ $list->total_panen }}</strong></td>
                            <td><strong> EKOR </strong></td>


                            <td style="width: 50px;"></td>
                            <td><strong>TONASE PANEN</strong></td>
                            <td><strong>{{ $list->tonase_panen }}</strong></td>
                            <td><strong> KG </strong></td>
                        </tr>

                        <tr>
                            <td><strong>RATA-RATA</strong></td>
                            <td><strong>{{ $list->rata_rata }}</strong></td>
                            <td><strong> KG </strong></td>
                        </tr>

                        <tr>
                            <td><strong>PAKAN</strong></td>
                            <td><strong>{{ $list->pakan }}</strong></td>
                            <td><strong> KG </strong></td>

                            <td style="width: 50px;"></td>
                            <td><strong>STD </strong></td>
                            <td><strong>{{ $list->std_pakan }}</strong></td>
                            <td></td>
                            {{-- <td><strong> KG </strong></td> --}}

                            <td style="width: 50px;"></td>
                            <td><strong>DIFF </strong></td>
                            <td><strong>{{ $list->diff_pakan }}</strong></td>
                            {{-- <td><strong> KG </strong></td> --}}
                        </tr>

                        <tr>
                            <td><strong>FCR</strong></td>
                            <td><strong>{{ $list->fcr }}</strong></td>
                            <td><strong> </strong></td>
                            <td style="width: 50px;"></td>
                            <td><strong>STD</strong></td>
                            <td><strong>{{ $list->std_fcr }}</strong></td>
                            <td><strong> </strong></td>
                            <td style="width: 50px;"></td>
                            <td><strong>DIFF</strong></td>
                            <td><strong>{{ $list->diff_fcr }}</strong></td>
                            <td><strong> </strong></td>
                        </tr>
                    </table>

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
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-center">TOTAL</th>
                                    <th>{{ $list->total_jumlah_bibit }}</th>
                                    <th>Rp. {{ number_format($list->harga_bibit_avg, 2) }}</th>
                                    <th>Rp. {{ number_format($list->total_harga_bibit), 2 }}</th>
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

                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-center">TOTAL</th>
                                    <th>{{ $list->total_jumlah_pakan }}</th>
                                    <th>Rp. {{ number_format($list->harga_pakan_avg, 2) }}</th>
                                    <th>Rp. {{ number_format($list->total_harga_pakan, 2) }}</th>
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

                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-center">TOTAL</th>
                                    <th>{{ $list->total_jumlah_obat }}</th>
                                    <th> Rp. {{ number_format($list->harga_obat_avg, 2) }}</th>
                                    <th> Rp. {{ number_format($list->total_harga_obat, 2) }}</th>
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
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-center">TOTAL</th>
                                    <th>{{ $list->total_jumlah_panen }}</th>
                                    <th>{{ $list->total_tonase_panen }}</th>
                                    <th>{{ number_format($list->rata_rata_avg, 2) }} KG</th>
                                    <th>Rp. {{ number_format($list->harga_kontrak_avg, 2) }}</th>
                                    <th>Rp. {{ number_format($list->total_harga_panen, 2) }}</th>
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
                                    <td>Rp. {{ number_format($list->total_harga_panen, 2) }}</td>
                                    <td>Rp. {{ number_format($list->total_harga_bibit, 2) }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td></td>
                                    <td>Rp. {{ number_format($list->total_harga_pakan, 2) }}</td>
                                    <td></td>

                                </tr>

                                <tr>
                                    <td>{{ $no++ }} </td>
                                    <td></td>
                                    <td>Rp. {{ number_format($list->total_harga_obat, 2) }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><strong>Total</strong></td>
                                    <td><strong>Rp.
                                            {{ number_format($list->total_harga_panen) }}</strong>
                                    </td>
                                    <td><strong>Rp.
                                            {{ number_format($list->total_harga_bibit + $list->total_harga_pakan + $list->total_harga_obat, 2) }}</strong>
                                    </td>
                                    <td>
                                        <strong>Rp.
                                            {{ number_format($list->total_harga_panen - ($list->total_harga_bibit + $list->total_harga_pakan + $list->total_harga_obat), 2) }}</strong>
                                    </td>
                                </tr>

                            </tbody>
                            {{-- @endforeach --}}
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

{{-- @push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#bibit').DataTable({
                paging: true,
                lengthChange: true, // show entries
                searching: true, // search bar
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,
                columnDefs: [{
                        targets: 0, // Kolom NO.
                        orderable: false,
                        searchable: false
                    },
                    @if (auth()->user()->level === 'ADMIN' || auth()->user()->level === 'TS')
                        {
                            targets: -1, // Kolom AKSI
                            orderable: false,
                            searchable: false,
                            className: 'text-center'
                        }
                    @endif
                ]
            });
        });

          $('#print-stokBibit').click(function(e) {
            e.preventDefault();
            var kandangId = $('#kandang_id').val();
            var url = '{{ route('print.transaksiBibit') }}';
            if (kandangId) {
                url += '?kandang_id=' + kandangId;
            }
            window.open(url, '_blank');
        });
    </script>
@endpush --}}
