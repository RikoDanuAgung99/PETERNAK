@extends('adminlte::page')

@section('title', 'Data Pengguna')

@section('content_header')
    <h1 class="m-0 text-dark">Data Pengguna</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Tambah Data Pengguna</strong></h3>
                </div>
                <div class="card-body">

                    @include('partials._error')

                    <form action="{{ route('pengguna.store') }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="form-label col-sm-1">Nama Lengkap</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" name="name" id="name" placeholder="Masukkan Nama Lengkap"
                                        class="form-control" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <label for="email" class="form-label col-sm-1">Email</label>
                            <div class="col-sm-3">
                                <input type="email" name="email" id="email" placeholder="Masukkan Email"
                                    class="form-control" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="form-label col-sm-1">Password</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="password" name="password" id="password" placeholder="Masukkan Password"
                                        class="form-control" required>
                                </div>
                            </div>
                            <label for="leve1" class="form-label col-sm-1">Level</label>
                            <div class="col-sm-3">
                                <select name="level" id="level" class="form-control" required>
                                    <option value="" selected disabled>-- Pilih Level --</option>
                                    <option value="ADMIN">ADMIN</option>
                                    <option value="PETERNAK">PETERNAK</option>
                                    <option value="TS">TS</option>
                                </select>
                            </div>
                            {{-- <div id="kandang-wrapper" style="display:none;"> --}}
                                {{-- <div class="row align-items-center"> --}}
                                    <label for="kandang_id" class="col-sm-1" id="kandang-wrapper1" style="display:none;" >Kandang</label>
                                    <div class="col-sm-3"  id="kandang-wrapper" style="display:none;">
                                        <select name="kandang_id" id="kandang_id" class="form-control" required>
                                            <option value="" selected disabled>-- Pilih Kandang --</option>
                                            @foreach ($kandang as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                {{-- </div> --}}
                            {{-- </div> --}}
                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info" id="simpan">SIMPAN</button>
                            <a href="{{ route('pengguna.index') }}" class="btn btn-danger">BATAL</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
         document.getElementById('level').addEventListener('change', function() {
            const kandangWrapper = document.getElementById('kandang-wrapper1');
            if (this.value === 'PETERNAK') {
                kandangWrapper.style.display = 'block';
                kandangWrapper.querySelector('select').setAttribute('required', 'required');
            } else {
                kandangWrapper.style.display = 'none';
                kandangWrapper.querySelector('select').removeAttribute('required');
                kandangWrapper.querySelector('select').value = '';
            }
        });
        document.getElementById('level').addEventListener('change', function() {
            const kandangWrapper = document.getElementById('kandang-wrapper');
            if (this.value === 'PETERNAK') {
                kandangWrapper.style.display = 'block';
                kandangWrapper.querySelector('select').setAttribute('required', 'required');
            } else {
                kandangWrapper.style.display = 'none';
                kandangWrapper.querySelector('select').removeAttribute('required');
                kandangWrapper.querySelector('select').value = '';
            }
        });
    </script>
@stop
