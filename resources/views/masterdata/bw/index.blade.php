@extends('adminlte::page')

@section('title', 'Data Bobot')

@section('plugins.Datatables', true)

@section('content_header')
    <h1 class="m-0 text-dark">Data Bobot</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Table Data Bobot </strong></h2>
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
                        @if (auth()->user()->level === 'ADMIN' || auth()->user()->level === 'PETERNAK')
                            <a href="{{ route('bw.create') }}" class="btn btn-primary btn-md"> Tambah Bobot</a>
                        @endif
                        <a href="{{ route('print.bw') }}" class="btn btn-success btn-md" id="print-bw"> Print Bobot</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="bw"
                            data-user-level="{{ auth()->user()->level }}">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>TANGGAL</th>
                                    <th>UMUR (HARI)</th>
                                    <th>BOBOT ACTUAL(g)</th>
                                    <th>BOBOT STANDAR(g)</th>
                                    <th>DIFFERENT BOBOT(g)</th>
                                    <th>KETERANGAN</th>
                                    @if (auth()->user()->level === 'ADMIN' || auth()->user()->level === 'PETERNAK')
                                        <th class="text-center">AKSI</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody></tbody>
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
            var userLevel = $('#bw').data('user-level');

            var columns = [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'umur',
                    name: 'umur'
                },
                {
                    data: 'bw_act',
                    name: 'bw_act'
                },
                {
                    data: 'bw_std',
                    name: 'bw_std'
                },
                {
                    data: 'dif_bw',
                    name: 'dif_bw'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
            ];

            if (userLevel === 'ADMIN' || userLevel === 'PETERNAK') {
                columns.push({
                    data: 'aksi',
                    name: 'aksi',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                });
            }
            $('#bw').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('get.bw') }}',
                columns: columns,
                order: [
                    [0, 'desc']
                ]
            });
        });
        $('#print-bw').click(function(e) {
            e.preventDefault();
            var kandangId = $('#kandang_id').val();
            var url = '{{ route('print.bw') }}';
            if (kandangId) {
                url += '?kandang_id=' + kandangId;
            }
            window.open(url, '_blank');
        });
    </script>
@endpush
