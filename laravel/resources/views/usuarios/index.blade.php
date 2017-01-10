@extends('layouts.app')

@section('htmlheader_title', 'Usuarios - Lista')

@section('contentheader_title', 'Listar Usuarios')

@section('contentheader_description', '')

@section('cant-content-header')
    {{ $usuarios->count() }}
@endsection

@section('title-content-header', ' Ingresar Usuarios')
@section('title2-content-header', 'Listar Usuarios')

@section('url-content-header-create')
    {{ url('admin/usuarios/create') }}
@endsection
@section('url-list-content-header')
    {{ url('admin/usuarios') }}
@endsection

@section('main-content')
@include('layouts.partials.maincontentheader')
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Usuarios</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <!--<th>Categorias</th>-->
                                <th>Estado</th>
                                <th>Accion</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usuarios as $user)

                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->apellido }}</td>
                                    <td>{{ $user->email}}</td>
                                    <td>{{ $user->estado }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="usuarios/{{ $user->id }}/edit" class="btn btn-warning btn-sm">Editar</a>
                                            <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a class="btn btn-default btn-group-sm" href="usuarios/{{ $user->id }}/edit">Editar</a>
                                                </li>
                                                <li>
                                                    <form action="{{ url('admin/usuarios/'.$user->id) }}" method="post">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-default btn-xs" style="width: 100%">Eliminar</button>
                                                    </form>
                                                </li>
                                                </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <!--<th>Categorias</th>-->
                                <th>Estado</th>
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