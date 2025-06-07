<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laporan Data Rekapitulasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Styling Kop Surat */
        .kop-container {
            position: fixed;
            top: -20px;
            left: 0;
            right: 0;
            z-index: 1000;
            background: white;
            padding-top: 20px;
            padding-bottom: 10px;
        }

        .kop {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            width: 100%;
            min-height: 100px;
        }

        .kop img {
            width: 100px;
            height: auto;
            position: absolute;
            left: 20px;
            top: 0;
        }

        .kop-text {
            text-align: center;
            flex-grow: 1;
            line-height: 1.4;
        }

        .kop-text h2,
        .kop-text p {
            margin: 5px 0;
        }

        /* Separator */
        .separator {
            border: 2px solid black;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        /* Konten dimulai setelah kop */
        .content {
            margin-top: 140px;
            page-break-before: always;
            /* sesuaikan tinggi kop+separator */
        }

        /* Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Tanda Tangan */
        .signature {
            font-size: 12px;
            width: 50%;
            text-align: center;
            margin-top: 30px;
            margin-left: auto;
        }

        /* Print Mode */
        @media print {
            body {
                margin: 0;
            }

            .kop-container {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                background: white;
                padding-top: 20px;
                padding-bottom: 10px;
            }

            .content {
                margin-top: 160px;
            }

            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>

<body>

    <div class="kop-container">
        <div class="kop">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/cv.PNG'))) }}"
                alt="Logo">
            <div class="kop-text">
                <h2>CV MILENIA SARANA INFORMATIKA</h2>
                <p>Jl. Kupang No. 93, Tanah Bumbu, Indonesia</p>
                <p>Telp: (851) 61651610</p>
            </div>
        </div>
        <hr class="separator">
    </div>

    <h2 style="text-align: center;">Laporan Data Rekapitulasi</h2>

    <div class="card-body" style="font-size: 12px;">
        <table class="table table-borderless w-auto " style="border: none; text-align:left; background: none; ">
            <tr style="border: none; text-align:left; background: none; ">
                <td style="border: none; text-align:left; background: none; "><strong>BIBIT MASUK</strong></td>
                <td style="border: none; text-align:left; background: none; ">
                    <strong>{{ $list->jml_bibit }}</strong>
                </td>
                <td style="border: none; text-align:left; background: none; "><strong> EKOR </strong></td>
            </tr>

            <tr>
                <td style="border: none; text-align:left; background: none; "><strong>DEPLESI</strong></td>
                <td style="border: none; text-align:left; background: none; ">
                    <strong>{{ $list->jml_kematian }}</strong>
                </td>
                <td style="border: none; text-align:left; background: none; "><strong> EKOR </strong></td>
            </tr>
            <tr>
                <td style="border: none; text-align:left; background: none; "><strong>SISA AYAM</strong></td>
                <td style="border: none; text-align:left; background: none; ">
                    <strong>{{ $list->sisa_ayam }}</strong>
                </td>
                <td style="border: none; text-align:left; background: none; "><strong> EKOR </strong></td>
            </tr>

            <tr>
                <td style="border: none; text-align:left; background: none; "><strong>DEPLESI (%)</strong></td>
                <td style="border: none; text-align:left; background: none; "><strong> {{ $list->deplesi }}
                    </strong>
                </td>
                <td style="border: none; text-align:left; background: none; "><strong> % </strong></td>
                <td style="border: none; text-align:left; background: none; "><strong></strong></td>
                <td style="border: none; text-align:left; background: none; "><strong>STD</strong></td>
                <td style="border: none; text-align:left; background: none; ">
                    <strong>{{ $list->std_deplesi }}</strong>
                </td>
                <td style="border: none; text-align:left; background: none; "><strong> % </strong></td>
                <td style="border: none; text-align:left; background: none;  "></td>
                <td style="border: none; text-align:left; background: none; "><strong>DIFF</strong></td>
                <td style="border: none; text-align:left; background: none; ">
                    <strong>{{ $list->diff_deplesi }}</strong>
                </td>
                <td style="border: none; text-align:left; background: none; "><strong> % </strong></td>
            </tr>

            <tr>
                <td style="border: none; text-align:left; background: none; "><strong>TOTAL PANEN</strong></td>
                <td style="border: none; text-align:left; background: none; ">
                    <strong>{{ $list->total_panen }}</strong>
                </td>
                <td style="border: none; text-align:left; background: none; "><strong> EKOR </strong></td>


                <td style="border: none; text-align:left; background: none;  "></td>
                <td style="border: none; text-align:left; background: none; "><strong>TONASE PANEN</strong></td>
                <td style="border: none; text-align:left; background: none; ">
                    <strong>{{ $list->tonase_panen }}</strong>
                </td>
                <td style="border: none; text-align:left; background: none; "><strong> KG </strong></td>
            </tr>

            <tr>
                <td style="border: none; text-align:left; background: none; "><strong>RATA-RATA</strong></td>
                <td style="border: none; text-align:left; background: none; ">
                    <strong>{{ $list->rata_rata }}</strong>
                </td>
                <td style="border: none; text-align:left; background: none; "><strong> KG </strong></td>
            </tr>

            <tr>
                <td style="border: none; text-align:left; background: none; "><strong>PAKAN</strong></td>
                <td style="border: none; text-align:left; background: none; "><strong>{{ $list->pakan }}</strong>
                </td>
                <td style="border: none; text-align:left; background: none; "><strong> KG </strong></td>

                <td style="border: none; text-align:left; background: none;  "></td>
                <td style="border: none; text-align:left; background: none; "><strong>STD </strong></td>
                <td style="border: none; text-align:left; background: none; ">
                    <strong>{{ $list->std_pakan }}</strong>
                </td>
                <td style="border: none; text-align:left; background: none; "></td>
                {{-- <td style="border: none; text-align:left; background: none; "><strong> KG </strong></td> --}}

                <td style="border: none; text-align:left; background: none;  "></td>
                <td style="border: none; text-align:left; background: none; "><strong>DIFF </strong></td>
                <td style="border: none; text-align:left; background: none; ">
                    <strong>{{ $list->diff_pakan }}</strong>
                </td>
                {{-- <td style="border: none; text-align:left; background: none; "><strong> KG </strong></td> --}}
            </tr>

            <tr>
                <td style="border: none; text-align:left; background: none; "><strong>FCR</strong></td>
                <td style="border: none; text-align:left; background: none; "><strong>{{ $list->fcr }}</strong>
                </td>
                <td style="border: none; text-align:left; background: none; "><strong> </strong></td>
                <td style="border: none; text-align:left; background: none;  "></td>
                <td style="border: none; text-align:left; background: none; "><strong>STD</strong></td>
                <td style="border: none; text-align:left; background: none; "><strong>{{ $list->std_fcr }}</strong>
                </td>
                <td style="border: none; text-align:left; background: none; "><strong> </strong></td>
                <td style="border: none; text-align:left; background: none;  "></td>
                <td style="border: none; text-align:left; background: none; "><strong>DIFF</strong></td>
                <td style="border: none; text-align:left; background: none; ">
                    <strong>{{ $list->diff_fcr }}</strong>
                </td>
                <td style="border: none; text-align:left; background: none; "><strong> </strong></td>
            </tr>
        </table>

            <div class="table-responsive mt-5">
                <h3><strong>Transaksi Bibit</strong></h3>
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
                <h3><strong>Transaksi Pakan</strong></h3>
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
            
        <div class="content">
            <div class="table-responsive mt-5">
                <h3><strong>Transaksi Obat</strong></h3>
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
                <h3><strong>Transaksi Panen</strong></h3>
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
                <h5><strong></strong></h5>
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
    {{-- @php
        $chunks = $rekapitulasi->chunk(5);
    {{-- @if (!$loop->last)
            <div style="page-break-after: always;"></div>
        @endif --}}
    {{-- @endforeach --}}
    <div class="page-break">

        <div class="signature">
            <p><strong>TANAH BUMBU, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ strtoupper(\Carbon\Carbon::now()->translatedFormat('F Y')) }}</strong></p>
            <p><strong>MANAGER CV MILENIA SARANA INFORMATIKA</strong></p>
            <br><br><br>
            <p>_________________________________________</p>
            <p><strong>RIKO DANU AGUNG</strong></p>
        </div>
    </div>
</body>


</html>
