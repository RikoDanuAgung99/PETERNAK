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
                    <h3 class="card-title"><strong>Edit Data Pengguna</strong></h3>
                </div>
                <div class="card-body">
                    @include('partials._error')
                    <form action="{{ route('pengguna.update', $pengguna->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label class="form-label col-sm-1">Nama Lengkap</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" name="name" placeholder="Masukkan Nama Lengkap"
                                        class="form-control" value="{{ isset($pengguna) ? $pengguna->name : old('name') }}"
                                        required>
                                </div>
                            </div>
                            <label class="form-label col-sm-1">Email</label>
                            <div class="col-sm-3">
                                <input type="email" name="email" placeholder="Masukkan Email" class="form-control"
                                    value="{{ isset($pengguna) ? $pengguna->email : old('email') }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="form-label col-sm-1">Password</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="password" name="password" placeholder="Masukkan Password"
                                        class="form-control" value="{{ old('password') }}">
                                </div>
                            </div>
                            <label for="level" class="form-label col-sm-1">Level</label>
                            <div class="col-sm-3">
                                <select name="level" id="level" class="form-control" required>
                                    <option value="" disabled
                                        {{ old('level', $user->level ?? '') == '' ? 'selected' : '' }}>-- Pilih Level --
                                    </option>
                                    <option value="ADMIN"
                                        {{ old('level', $user->level ?? '') == 'ADMIN' ? 'selected' : '' }}>ADMIN</option>
                                    <option value="PETERNAK"
                                        {{ old('level', $user->level ?? '') == 'PETERNAK' ? 'selected' : '' }}>PETERNAK
                                    </option>
                                    <option value="TS" {{ old('level', $user->level ?? '') == 'TS' ? 'selected' : '' }}>
                                        TS</option>
                                </select>
                            </div>


                            <label for="kandang_id" class="col-sm-1" id="kandang-wrapper1"
                                style="{{ old('level', $user->level ?? '') == 'PETERNAK' ? '' : 'display:none;' }}">Kandang</label>
                            <div class="col-sm-3" id="kandang-wrapper"
                                style="{{ old('level', $user->level ?? '') == 'PETERNAK' ? '' : 'display:none;' }}">
                                <select name="kandang_id" id="kandang_id" class="form-control" required>
                                    <option value="" disabled
                                        {{ old('kandang_id', $user->kandang_id ?? '') == '' ? 'selected' : '' }}>-- Pilih
                                        Kandang --</option>
                                    @foreach ($kandang as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('kandang_id', $user->kandang_id ?? '') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


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
        document.addEventListener('DOMContentLoaded', function() {
            const levelSelect = document.getElementById('level');
            const kandangLabel = document.getElementById('kandang-wrapper1');
            const kandangDiv = document.getElementById('kandang-wrapper');
            const kandangSelect = document.getElementById('kandang_id');

            function toggleKandang() {
                if (levelSelect.value === 'PETERNAK') {
                    kandangLabel.style.display = 'block';
                    kandangDiv.style.display = 'block';
                    kandangSelect.setAttribute('required', 'required');
                } else {
                    kandangLabel.style.display = 'none';
                    kandangDiv.style.display = 'none';
                    kandangSelect.removeAttribute('required');
                    kandangSelect.value = '';
                }
            }

            toggleKandang();

            levelSelect.addEventListener('change', toggleKandang);
        });
    </script>

@stop
