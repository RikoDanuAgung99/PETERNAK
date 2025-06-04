@extends('adminlte::page')

@section('title', 'Transaksi Panen')

@section('plugins.Datatables', true)

@php
    $page = Request::get('page') ? Request::get('page') : 1;
    $no = ($page - 1) * $halaman + 1;
@endphp

@section('content_header')
    <h1 class="m-0 text-dark">Data Panen</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Table Data Panen </strong></h2>
                    <div class="form-group float-right">
                        @php
                            $user = auth()->user();
                        @endphp
                        @if ($user->level !== 'PETERNAK')
                            <select class="form-control d-inline-block" style="width:auto;" name="kandang_id" id="kandang_id"
                                onchange="window.location.href='?kandang_id=' + this.value;">
                                <option value="">-- Pilih Kandang --</option>
                                @foreach ($kandang as $item)
                                    <option value="{{ $item->id }}"
                                        {{ request('kandang_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <input type="hidden" id="kandang_id" value="{{ $user->kandang_id }}"
                                data-user-level="PETERNAK">
                        @endif
                        @if (auth()->user()->level === 'ADMIN' || auth()->user()->level === 'TS')
                            <a href="{{ route('panen.create') }}" class="btn btn-primary btn-md"> Tambah Panen</a>
                        @endif
                        <a href="{{ route('print.panen') }}" target="_blank" class="btn btn-success btn-md"
                            id="print-panen">
                            Print Panen</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
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

                                    @if (auth()->user()->level === 'ADMIN' || auth()->user()->level === 'TS')
                                        <th class="text-center">AKSI</th>
                                    @endif
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
                                        @if (auth()->user()->level === 'ADMIN' || auth()->user()->level === 'TS')
                                            <td class="text-center">
                                                <a href="{{ route('panen.edit', $item->id) }}"
                                                    class="btn btn-sm btn-warning">Edit</a>
                                                <form action="{{ route('panen.destroy', $item->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Hapus data ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#panen').DataTable({
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
            $('#print-panen').click(function(e) {
                e.preventDefault();
                var kandangId = $('#kandang_id').val();
                var url = '{{ route('print.panen') }}';
                if (kandangId) {
                    url += '?kandang_id=' + kandangId;
                }
                window.open(url, '_blank');
            });
        });
    </script>
@endpush
