@extends('layouts.boxed')

@section('title')
    Jadwal
@stop

@section('content')
    @include('partials.flash-overlay-modal')

    <section class="content-header">
        <h1>Jadwal</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('schedule.create') }}" class="btn btn-primary" title="Tambah">
                    <span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Tambah
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">List Jadwal</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped table-hover table-bordered" id="table-event">
                            <thead>
                            <tr>
                                <th class="col-md-1 text-center">
                                    #
                                </th>
                                <th class="col-md-2 text-center">
                                    Jadwal
                                </th>
                                <th class="col-md-2 text-center">
                                    Kelas
                                </th>
                                <th class="col-md-3 text-center">
                                    Waktu
                                </th>
                                <th class="col-md-3 text-center">
                                    Lokasi
                                </th>
                                <th class="col-md-1 text-center">
                                    Menu
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1;?>
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>

                                <td><a href="" class="text-center"
                                       title="">Sesilab
                                    </a>
                                </td>

                                <td class="text-center">
                                    Struktur Data A
                                </td>

                                <td class="text-center">
                                    Setiap Kamis Jam 19.00
                                </td>

                                <td class="text-center">
                                    Laboratorium Pemrograman 2
                                </td>

                                <td class="text-center">
                                    <a href="" class="btn btn-primary btn-xs"title="Sunting"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal"><span class="glyphicon glyphicon-remove"></span></button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Hapus Jadwal</h4>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin menghapus jadwal ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    <a href="">
                                                        <button type="button" class="btn btn-primary">Ok!!</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('foot')

    <script src="{{ url('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script event="text/javascript">
        $(document).ready(function(){
//              pagination
            $('#table-event').DataTable({
                "paging": true,
                "searching": true
            });
            $('#flash-overlay-modal').modal();
        });
    </script>
@endsection
