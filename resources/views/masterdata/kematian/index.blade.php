@extends('adminlte::page')

@section('title', 'Data Kematian')

@section('plugins.Datatables', true)

@section('content_header')
    <h1 class="m-0 text-dark">Data Kematian</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Table Data Kematian</strong></h2>
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
                            <a href="{{ route('kematian.create') }}" class="btn btn-primary btn-md"> Tambah Kematian</a>
                        @endif
                        <a href="{{ route('print.kematian') }}" class="btn btn-success btn-md" id="print-kematian">Print
                            Kematian</a>

                    </div>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="kematian"
                            data-user-level="{{ auth()->user()->level }}">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>TANGGAL</th>
                                    <th>UMUR (HARI)</th>
                                    <th>KEMATIAN (EKOR)</th>
                                    <th>PENYEBAB KEMATIAN</th>
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
            var userLevel = $('#kematian').data('user-level');

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
                    data: 'kematian',
                    name: 'kematian'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                }
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

            $('#kematian').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('get.kematian') }}',
                columns: columns,
                order: [
                    [0, 'desc']
                ]
            });
        });


        $('#print-kematian').click(function(e) {
            e.preventDefault();
            var kandangId = $('#kandang_id').val();
            var url = '{{ route('print.kematian') }}';
            if (kandangId) {
                url += '?kandang_id=' + kandangId;
            }
            window.open(url, '_blank');
        });
    </script>
@endpush
