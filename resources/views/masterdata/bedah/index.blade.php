@extends('adminlte::page')

@section('title', 'Data Bedah')

@section('plugins.Datatables', true)

@section('content_header')
    <h1 class="m-0 text-dark">Data Bedah</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Table Data Bedah</strong></h2>
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
                            <a href="{{ route('bedah.create') }}" class="btn btn-primary btn-md"> Tambah Bedah</a>
                        @endif
                        <a href="{{ route('print.bedah') }}" class="btn btn-success btn-md" id="print-bedah"> Print
                            Bedah</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="bedah">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>TANGGAL</th>
                                    <th>UMUR (HARI)</th>
                                    <th>GEJALA</th>
                                    <th>DIAGNOSIS</th>
                                    <th>FOTO</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>

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
            var userLevel = $('#kandang_id').data('user-level');

            var table = $('#bedah').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                stateSave: true,
                order: [
                    [0, "desc"]
                ],
                ajax: {
                    url: '{{ route('get.bedah') }}',
                    data: function(d) {
                        if (userLevel !== 'PETERNAK') {
                            d.kandang_id = $('#kandang_id').val();
                        }
                    }
                },
                columns: [{
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
                        data: 'gejala',
                        name: 'gejala'
                    },
                    {
                        data: 'diagnosis',
                        name: 'diagnosis'
                    },
                    {
                        data: 'images',
                        name: 'images',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            if (data) {
                                let imagePath = '/storage/bedah/' + data;
                                let modalId = 'imageModal' + full.id;

                                return `
                <img src="${imagePath}" 
                     style="width:50px; height:50px; object-fit:cover; cursor:pointer;" 
                     data-toggle="modal" 
                     data-target="#${modalId}">

                <div class="modal fade" id="${modalId}" tabindex="-1" role="dialog" aria-labelledby="${modalId}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <img src="${imagePath}" class="img-fluid" alt="Preview">
                            </div>
                        </div>
                    </div>
                </div>
            `;
                            }
                            return '-';
                        }
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }
                ]
            });
            if (userLevel !== 'PETERNAK') {
                $('#kandang_id').change(function() {
                    table.ajax.reload();
                });
            }
        });
        $('#print-bedah').click(function(e) {
            e.preventDefault();
            var kandangId = $('#kandang_id').val();
            var url = '{{ route('print.bedah') }}';
            if (kandangId) {
                url += '?kandang_id=' + kandangId;
            }
            window.open(url, '_blank');
        });
    </script>
@endpush
