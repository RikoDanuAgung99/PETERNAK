<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Data Pakan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

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
        .kop-text h2, .kop-text p {
            margin: 5px 0;
        }

        .separator {
            border: 2px solid black;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .signature {
            width: 50%;
            text-align: center;
            margin-top: 30px;
            margin-left: auto;
        }

        @media print {
            .kop img {
                display: block !important;
                max-width: 80px !important;
                height: auto !important;
            }
        }
    </style>
</head>
<body>
    <div class="kop">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/cv.PNG'))) }}" alt="Logo">
        <div class="kop-text">
            <h2>CV MILENIA SARANA INFORMATIKA</h2>
            <p>Jl. Kupang No. 93, Tanah Bumbu, Indonesia</p>
            <p>Telp: (851) 61651610</p>
        </div>
    </div>

    <hr class="separator">

    <h2 style="text-align: center;">Laporan Data Penggunaan Pakan</h2>
    <table>
        <tr>
            <th>NO.</th>
            <th>TANGGAL</th>
            <th>UMUR (HARI)</th>
            {{-- <th>NAMA PAKAN</th> --}}
            <th>JENIS PAKAN</th>
            <th>JUMLAH PAKAN</th>
        </tr>
        @php $no = 1; @endphp
        @foreach ($pakan as $pk)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $pk->tanggal }}</td>
            <td>{{ $pk->umur }}</td>
            {{-- <td>{{ $pk->nama }}</td> --}}
            <td>{{ $pk->jenis }}</td>
            <td>{{ $pk->jumlah }}</td>
        </tr>
        @endforeach
    </table>

    <div class="signature">
        <p><strong>TANAH BUMBU, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FEBRUARI 2025</strong></p>
        <p><strong>MANAGER CV MILENIA SARANA INFORMATIKA</strong></p>
        <br><br><br>
        <p>_________________________________________</p>
        <p><strong>RIKO DANU AGUNG</strong></p>
    </div>
</body>
</html>
