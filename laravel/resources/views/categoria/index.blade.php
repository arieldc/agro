@extends('layouts.app')

@section('htmlheader_title', 'Categorias - Lista')

@section('contentheader_title', 'Listar Categorias')

@section('contentheader_description', '')

@section('cant-content-header')
    {{ $categoria->count() }}
@endsection

@section('title-content-header', ' Ingresar Categorias')
@section('title2-content-header', 'Listar Categorias')

@section('url-content-header-create')
    {{ url('admin/categoria/create') }}
    @endsection
@section('url-list-content-header')
    {{ url('admin/categoria') }}
    @endsection

@section('main-content')
    @include('layouts.partials.maincontentheader')
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Categorias</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-hover">
                            <thead>
                            <tr>
                                <th class="hidden"></th>
                                <th>Nombre</th>
                                <th>Orden</th>
                                <th>Estado</th>
                                <th>Atributos</th>
                                <th>Accion</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categoria as $cat)
                                @if($cat->id_padre == 0)
                                <tr>
                                    <td class="hidden"></td>
                                    <td>{{ $cat->nombre }}</td>
                                    <td>{{ $cat->orden }}</td>
                                    <td>{{ $cat->estado }}</td>
                                    <td><a href="categoria/{{ $cat->id }}/atributos" class="btn btn-success btn-sm">{{ $cat->countAtributos($cat->id)->count() }} =></a></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="categoria/{{ $cat->id }}/edit" class="btn btn-warning btn-sm">Editar</a>
                                            <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="categoria/{{ $cat->id }}/edit" class="btn btn-default btn-sm">Editar</a></li>
                                                <li><a href="categoria/{{ $cat->id }}/atributos" class="btn btn-default btn-sm">Atributos</a></li>
                                                <li>
                                                    <form action="{{ url('admin/categoria/'.$cat->id) }}" method="post" >
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button type="submit" class="btn btn-default btn-sm" style="width: 100%">Eliminar</button>
                                                    </form>
                                                </li>
                                                    <!--<a href="#">Eliminar</a></li>-->
                                                <!--<li class="divider"></li>
                                                <li><a href="#">Separated link</a></li>-->
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                @foreach($cat->children as $cat2)
                                    @if($cat2->id == $cat->id_padre)@endif
                                        <tr>
                                            <td class="hidden"></td>
                                            <td>{{$cat->nombre.' > '.$cat2->nombre }}</td>
                                            <td>{{ $cat2->orden }}</td>
                                            <td>{{ $cat2->estado }}</td>
                                            <td><a href="categoria/{{ $cat2->id }}/atributos" class="btn btn-success btn-sm">{{ $cat->countAtributos($cat2->id)->count() }} =></a></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="categoria/{{ $cat2->id }}/edit" class="btn btn-warning btn-sm">Editar</a>
                                                    <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="categoria/{{ $cat2->id }}/edit" class="btn btn-default btn-sm">Editar</a></li>
                                                        <li><a href="categoria/{{ $cat2->id }}/atributos" class="btn btn-default btn-sm">Atributos</a></li>
                                                        <li>
                                                            <form action="{{ url('admin/categoria/'.$cat2->id) }}" method="post" >
                                                                {{ method_field('DELETE') }}
                                                                {{ csrf_field() }}
                                                                <button type="submit" class="btn btn-default btn-sm" style="width: 100%">Eliminar</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                @endforeach
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="hidden"></th>
                                <th>Nombre</th>
                                <th>Orden</th>
                                <th>Estado</th>
                                <th>Atributos</th>
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