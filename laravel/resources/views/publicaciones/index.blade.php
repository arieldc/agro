@extends('layouts.app')

@section('htmlheader_title', 'Publicaciones - Lista')

@section('contentheader_title', 'Listar Publicaciones')

@section('contentheader_description', '')

@section('cant-content-header')
    {{ $publicaciones->count() }}
@endsection

@section('title-content-header', ' Ingresar Publicaciones')
@section('title2-content-header', 'Listar Publicaciones')

@section('url-content-header-create')
    {{ url('admin/publicaciones/create') }}
@endsection
@section('url-list-content-header')
    {{ url('admin/publicaciones') }}
@endsection

@section('main-content')
@include('layouts.partials.maincontentheader')
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Publicaciones</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Titulo</th>
                                <th>Precio</th>
                                <th>Descripcion</th>
                                <!--<th>Categorias</th>-->
                                <th>Estado</th>
                                <th>Accion</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($publicaciones as $publi)
                                @php
                                    if ($publi->estado == 'activo'){
                                        $activo = 'active';
                                        $checkedyes = 'checked';
                                        }
                                    else{
                                        $checkedyes = '';
                                        $activo = '';
                                        }

                                    if ($publi->estado == 'inactivo'){
                                        $inactivo = 'active';
                                        $checkedno = 'checked';
                                        }
                                    else{
                                        $inactivo = '';
                                        $checkedno = '';
                                        }
                                @endphp
                                <tr>
                                    <td>
                                    @foreach($publi->publicacionImagen as $imagen)
                                        <img src="../{{ $imagen->ruta }}" class="img-responsive" style="background-size: cover" width="200px" height="200px">
                                        @break
                                    @endforeach
                                    </td>
                                    <td>{{ $publi->titulo }}</td>
                                    <td>{{ $publi->precio }}</td>
                                    <td>{{ str_limit($publi->descripcion, 50) }}</td>
                                        <!--<td>-->
                                        @foreach($publi->publicacionCategoria as $categoria)

                                        @endforeach
                                        <!--</td>-->
                                    <td>
                                        <!--<div class="btn-group input-group" data-toggle="buttons">
                                            <label class="btn btn-primary btn-xs {{ $activo }}">
                                                <input type="radio" value="activo" name="estado" {{$checkedyes}}>Activo</label>
                                            <label class="btn btn-default btn-xs {{ $inactivo }}">
                                                <input type="radio" value="inactivo" name="estado" {{$checkedno}}>Inactivo</label>
                                        </div>-->

                                        {{ $publi->estado }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="publicaciones/{{ $publi->id }}/edit" class="btn btn-warning btn-sm">Editar</a>
                                            <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a class="btn btn-default btn-group-sm" href="publicaciones/{{ $publi->id }}/edit">Editar</a>
                                                </li>
                                                <li>
                                                    <a class="btn btn-default btn-group-sm" href="publicaciones/{{ $publi->id }}/imagen">Editar Galeria</a>
                                                </li>
                                                <li>
                                                    <a class="btn btn-default btn-group-sm" href="publicaciones/{{ $publi->id }}/atributos">Agregar atributos</a>
                                                </li>
                                                <li>
                                                    <form action="{{ url('admin/publicaciones/'.$publi->id) }}" method="post">
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
                                <th>Imagen</th>
                                <th>Titulo</th>
                                <th>Precio</th>
                                <th>Descripcion</th>
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