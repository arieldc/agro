@extends('layouts.app')

@section('htmlheader_title', 'Categorias - Editar')

@section('contentheader_title', 'Editar Categorias')

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
    <div class="col-md-9">
        @include('errors.errors')
        <!-- Horizontal Form -->
        <div class="box box-primary">
            <ul class="nav nav-tabs">
                <li class="active"><a href="{{ url('admin/categoria/'.$categoria->id.'/edit') }}" >General</a></li>
                <li class=""><a href="{{ url('admin/categoria/'.$categoria->id.'/atributos') }}" >Atributos Globales</a></li>
            </ul>
            <div class="tab-content">

                <div class="tab-pane active" id="tab_1">

                    <div class="box-header with-border">
                        <h3 class="box-title">Editar Categorias</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="{{ url('admin/categoria/'.$categoria->id) }}" method="post">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <div class="box-body">
                            @php
                                if($categoria->estado == 'activa'){
                                        $activeyes = 'active';
                                        $checkedyes = 'checked';
                                }
                                else{
                                    $activeyes = '';
                                    $checkedyes = '';
                                }
                                if($categoria->estado == 'inactiva'){
                                    $activeno = 'active';
                                    $checkedno = 'checked';
                                }
                                else{
                                    $activeno = '';
                                    $checkedno = '';
                                }
                            @endphp

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Estado</label>
                                <div class="col-sm-10">
                                    <div class="btn-group input-group" data-toggle="buttons">
                                        <label class="btn btn-primary {{ $activeyes }}">
                                            <input type="radio" value="activa" name="estado" {{$checkedyes}}>Activa</label>
                                        <label class="btn btn-default {{$activeno}}">
                                            <input type="radio" value="inactiva" name="estado" {{$checkedno}}>Inactiva</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="col-sm-2 control-label">Nombre</label>

                                <div class="col-sm-10">
                                    <input type="text" name="nombre" class="form-control" id="nombre"
                                           placeholder="Nombre" value="{{ $categoria->nombre }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_padre" class="col-sm-2 control-label">Categoria Padre</label>

                                <div class="col-sm-10">
                                    <select name="id_padre" id="id_padre" class="form-control select2">
                                        <option value="{{ $categoria->id_padre }}">{{ $nombrePadre }}</option>
                                        <option value="0">N/S</option>
                                        @foreach($todasCategoria as $todasCat)
                                            <option value="{{ $todasCat->id }}">{{ $todasCat->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="orden" class="col-sm-2 control-label">Orden</label>

                                <div class="col-sm-10">
                                    <input type="number" name="orden" class="form-control" id="orden"
                                           placeholder="Introduce orden" value="{{ $categoria->orden }}" required>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ url('admin/categoria') }}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-primary pull-right">Actualizar</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>

                    <form action="{{ url('admin/categoria/'.$categoria->id) }}" method="post">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger ">Eliminar</button>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('/plugins/select2/select2.full.min.js') }}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
        });
    </script>
@endsection