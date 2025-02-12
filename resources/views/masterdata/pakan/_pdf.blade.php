<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan Data Pakan</title>
        <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #dddddd;
        }
        .kop {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 5px;
        }
        .kop img {
            width: 100px;
            height: auto;
            margin-right: 15px;
        }
        .kop-text {
            text-align: center;
        }
        .signature {
            width: 50%;
            text-align: center;
            margin-top: 50px;
            margin-left: auto;
        }
    </style>
</head>
<body>
    <div class="kop">
        <img src="{{ asset('masterdata/bw/cv.PNG') }}" alt="Logo" style="width: 100px; height: auto; margin-right: 15px;">
        <div class="kop-text">
            <h2>CV MILENIA SARANA INFORMATIKA</h2>
            <p>Jl. Kupang No. 93, Tanah Bumbu, Indonesia</p>
            <p>Telp: (851) 61651610 </p>
        </div>
    </div>
     <hr>
    <h2 style="text-align: center;">Laporan Data Penggunaan Pakan</h2>
    <table>
        <tr>
            <th>NO.</th>
             <th>TANGGAL</th>
            <th>UMUR (HARI)</th>
            <th>NAMA PAKAN</th>
            <th>JENIS PAKAN</th>
            <th>JUMLAH PAKAN</th>
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($pakan as $pk)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $pk->tanggal }}</td>
            <td>{{ $pk->umur }}</td>
            <td>{{ $pk->nama }}</td>
            <td>{{ $pk->jenis }}</td>
            <td>{{ $pk->jumlah }}</td>
        </tr>
        @endforeach
    </table>

    <div class="signature">
        <p><strong>TANAH BUMBU, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; FEBRUARI 2025</strong></p>
        <p><strong>MANAGER CV MILENIA SARANA INFORMATIKA</strong></p>
        <br><br><br>
        <p>_________________________________________</p>
        <p><strong>RIKO DANU AGUNG</strong></p>
    </div>
</body>
</html>