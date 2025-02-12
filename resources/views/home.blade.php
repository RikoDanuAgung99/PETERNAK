@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">CV MILENIA SARANA INFORMATIKA</h1>
    <p class="text-center text-muted">JL. KUPANG, NO.93, TANAH BUMBU, INDONESIA</p>
@stop

@section('content')
<div class="container">
    <div class="row text-center">
        @php
            $images = [
                'kandang.jpg', 'ayam1.jpg', 'ayam2.jpg',
                'ayam3.jpg', 'nekropsi.jpg', 'nota.jpg'
            ];
        @endphp
        
        @foreach ($images as $image)
            <div class="col-md-4 mb-3">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <img src="{{ asset('images/' . $image) }}" class="img-fluid fixed-size rounded" alt="Gambar">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Visi & Misi -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center">Visi</h3>
                    <p class="text-center">Menjadi perusahaan peternakan ayam broiler terdepan yang mengintegrasikan teknologi informasi dalam setiap aspek operasional usaha, guna menghasilkan produk unggulan dan mendukung pertumbuhan usaha yang berkelanjutan.</p>
                    <hr>
                    <h3 class="text-center">Misi</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Menerapkan solusi teknologi informasi canggih, seperti aplikasi recording harian berbasis web, untuk meningkatkan efisiensi dan akurasi dalam manajemen peternakan.</li>
                        <li class="list-group-item">Menghasilkan ayam broiler berkualitas tinggi melalui sistem manajemen terintegrasi dan prosedur operasional standar yang ketat.</li>
                        <li class="list-group-item">Menyediakan layanan yang profesional dan responsif kepada pelanggan serta mitra usaha, dengan dukungan tim yang kompeten.</li>
                        <li class="list-group-item">Mengembangkan usaha peternakan dengan mengedepankan prinsip keberlanjutan, baik dari sisi ekonomi maupun lingkungan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <style>
        .fixed-size {
            width: 100%;
            height: 200px; /* Sesuaikan ukuran sesuai kebutuhan */
            object-fit: cover;
        }
    </style>
@stop
