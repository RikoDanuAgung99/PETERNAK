@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">SEPAKAT FARM</h1>
    <p class="text-center text-muted">JL. KUPANG, NO.93, TANAH BUMBU, INDONESIA</p>
@stop

@section('content')
<div class="container">
    <!-- Carousel -->
    <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @php
                $images = ['ayam3.jpg', 'kandang.3.jpg', 'ayam2.jpg'];
            @endphp
            
            @foreach ($images as $index => $image)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ asset('images/' . $image) }}" class="d-block w-100 rounded img-carousel" alt="Slide {{ $index + 1 }}">
                </div>
            @endforeach
        </div>
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
                        <li class="list-group-item">Menerapkan solusi teknologi informasi canggih untuk meningkatkan efisiensi dan akurasi dalam manajemen peternakan.</li>
                        <li class="list-group-item">Menghasilkan ayam broiler berkualitas tinggi melalui sistem manajemen terintegrasi dan prosedur operasional standar yang ketat.</li>
                        <li class="list-group-item">Menyediakan layanan yang profesional dan responsif kepada pelanggan serta mitra usaha.</li>
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
        .img-carousel {
            height: 400px;
            object-fit: cover;
        }
    </style>
@stop

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let carousel = new bootstrap.Carousel(document.querySelector('#imageCarousel'), {
                interval: 3000,
                wrap: true
            });
        });
    </script>
@stop
