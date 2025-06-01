@extends('adminlte::page')

@section('title', 'Data Bedah')

@section('plugins.Datatables', true)

@section('content_header')
    <h1 class="m-0 text-dark">Data Bedah</h1>
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
                <h2 class="card-title"><strong>Table Data Bedah</strong></h2>
                <div class="form-group float-right">
                    <a href="{{ route('bedah.create') }}" class="btn btn-primary btn-md"> Tambah Bedah</a>
                    <a href="{{ route('print.bedah') }}" class="btn btn-success btn-md"> Print Bedah</a>
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
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach ($bedah as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->umur }}</td>
                                    <td>{{ $item->gejala }}</td>
                                    <td>{{ $item->diagnosis }}</td>
                                    <td class="text-center">
                                        @if ($item->images)
                                            <img src="{{ asset('storage/bedah/' . $item->images) }}" alt="Foto"
                                                style="width: 50px; height: 50px; object-fit: cover; cursor: pointer;"
                                                data-toggle="modal" data-target="#imageModal{{ $item->id }}">

                                            <!-- Modal -->
                                            <div class="modal fade" id="imageModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel{{ $item->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body text-center">
                                                            <img src="{{ asset('storage/bedah/' . $item->images) }}" alt="Foto Besar" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('bedah.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('bedah.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $bedah->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('#bedah').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            stateSave: true,
            order: [[1, "desc"]],
            ajax: '{{ route('get.bedah') }}',
            columns: [
                {
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
                            return '<img src="{{ asset("storage/bedah") }}/' + data + '" style="width:50px; height:50px; object-fit:cover; cursor:pointer;" data-toggle="modal" data-target="#imageModal' + full.id + '">';
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
    });
</script>
@endpush
