@extends('adminlte::page')

@section('title', 'Data Rekap')

@section('plugins.Datatables', true)

@section('content_header')
    <h1 class="m-0 text-dark">Data Rekap</h1>
@stop

@php
    $page = Request::get('page') ? Request::get('page') : 1;
    $no = ($page - 1) * $halaman + 1;
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Table Data Rekap </strong></h2>
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
                        <a href="{{ route('print.rekap') }}" class="btn btn-success btn-md" id="print-rekap"> Print Data
                            Rekap</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="rekap">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>TANGGAL</th>
                                    <th>UMUR (HARI)</th>
                                    <th>JUMLAH KEMATIAN (EKOR)</th>
                                    <th>JUMLAH PAKAN (SAK)</th>
                                    <th>JUMLAH OBAT (BUNGKUS@100g)</th>
                                    <th>BOBOT ACTUAL (g)</th>
                                    <th>KETERANGAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($rekap as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->umur }}</td>
                                        <td>{{ $item->kematian }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>{{ $item->jumlahObat }}</td>
                                        <td>{{ $item->bw_act }}</td>
                                        <td>{{ $item->keterangan }}</td>
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
            $('#rekap').DataTable({
                paging: true, // Menampilkan "Show entries"
                lengthChange: true, // Mengaktifkan dropdown jumlah entri
                searching: true, // Menampilkan fitur pencarian
                ordering: true,
                columnDefs: [{
                    targets: 0, // kolom NO.
                    orderable: false,
                    searchable: false
                }]
            });
        });

         $('#print-rekap').click(function(e) {
            e.preventDefault();
            var kandangId = $('#kandang_id').val();
            var url = '{{ route('print.rekap') }}';
            if (kandangId) {
                url += '?kandang_id=' + kandangId;
            }
            window.open(url, '_blank');
        });
    </script>
@endpush
