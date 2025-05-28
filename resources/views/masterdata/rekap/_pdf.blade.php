<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laporan Data Rekap</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Styling Kop Surat */
        .kop {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-bottom: 30px;
            width: 100%;
            min-height: 100px;
        }

        .kop img {
            width: 200px;
            height: auto;
            position: absolute;
            left: 0;
            top: -50px;
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

        /* Menurunkan garis agar lebih jauh dari kop */
        .separator {
            border: 2px solid black;
            margin-top: 20px;
            margin-bottom: 10px;
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

        /* Styling Tanda Tangan */
        .signature {
            width: 50%;
            text-align: center;
            margin-top: 30px;
            margin-left: auto;
        }

        /* CSS Print */
        @media print {
            .kop img {
                display: block !important;
                max-width: 80px !important;
                height: auto !important;
            }
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    @php
        $chunks = $rekap->chunk(5); 
    @endphp

    @foreach ($chunks as $index => $chunk)
        <div class="kop">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/cv.PNG'))) }}" alt="Logo">
            <div class="kop-text">
                <h2>CV MILENIA SARANA INFORMATIKA</h2>
                <p>Jl. Kupang No. 93, Tanah Bumbu, Indonesia</p>
                <p>Telp: (851) 61651610</p>
            </div>
        </div>

        <hr class="separator">
        <h2 style="text-align: center;">Laporan Data Rekap</h2>

        <table>
            <tr>
                                    <th>NO.</th>
                                    <th>TANGGAL</th>
                                    <th>UMUR (HARI)</th>
                                    <th>JUMLAH KEMATIAN (EKOR)</th>
                                    <th>JUMLAH PAKAN (SAK)</th>
                                    <th>JUMLAH OBAT (BUNGKUS@100g)</th>
                                    <th>BOBOT ACTUAL (g)</th>
            </tr>
            @php $no = $index * 5 + 1; @endphp
            @foreach ($chunk as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->umur }}</td>
                    <td>{{ $item->kematian }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->jumlahObat }}</td>
                    <td>{{ $item->bw_act }}</td>
                </tr>
            @endforeach
        </table>
        @if (!$loop->last)
            <div style="page-break-after: always;"></div>
        @endif
    @endforeach

    <div class="signature">
        <p><strong>TANAH BUMBU, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FEBRUARI 2025</strong></p>
        <p><strong>MANAGER CV MILENIA SARANA INFORMATIKA</strong></p>
        <br><br><br>
        <p>_________________________________________</p>
        <p><strong>RIKO DANU AGUNG</strong></p>
    </div>
</body>


</html>
