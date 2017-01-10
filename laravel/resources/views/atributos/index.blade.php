@extends('layouts.app')

@section('htmlheader_title', 'Atributos - Lista')

@section('contentheader_title', 'Listar Atributos')

@section('contentheader_description', '')

@section('cant-content-header')
    {{ $atributos->count() }}
    @endsection

@section('title-content-header', ' Ingresar Atributos')
@section('title2-content-header', 'Listar Atributos')

@section('url-content-header-create')
    {{ url('admin/atributo/create') }}
    @endsection
@section('url-list-content-header')
    {{ url('admin/atributo') }}
    @endsection

@section('main-content')
    @include('layouts.partials.maincontentheader')
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Atributos</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped table-responsive">
                            <thead>
                            <tr>
                                <th class="hidden"></th>
                                <th>Nombre</th>
                                <th>Elemento</th>
                                <th>Orden</th>
                                <th>Requerido</th>
                                <th>Accion</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($atributos as $cat)
                                <tr>
                                    <td class="hidden"></td>
                                    <td>{{ $cat->nombre }}</td>
                                    <td>{{ $cat->elemento }}</td>
                                    <td>{{ $cat->orden }}</td>
                                    <td>{{ $cat->requerido }}</td>
                                    <td>
                                        <a class="btn btn-warning btn-xs" href="atributo/{{ $cat->id }}/edit">Editar</a>
                                        <form action="{{ url('admin/atributo/'.$cat->id) }}" method="post" class="form-horizontal">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="hidden"></th>
                                <th>Nombre</th>
                                <th>Elemento</th>
                                <th>Orden</th>
                                <th>Requerido</th>
                                <th>Accion</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                "language": {
                    "url": "http://agrofans.com/plugins/datatables/lang/Spanish.json"
                }
            });
        });
    </script>
    @endsection