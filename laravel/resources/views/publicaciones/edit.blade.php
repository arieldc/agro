@extends('layouts.app')

@section('htmlheader_title', 'Publicaciones - Editar')

@section('contentheader_title', 'Editar Publicaciones')

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
    <div class="col-md-9">
        @include('errors.errors')
        <!-- Horizontal Form -->
        <div class="box box-info">
            <ul class="nav nav-tabs">
                <li class="active"><a href="{{ url('admin/publicaciones/'.$publicaciones->id.'/edit') }}" >General</a></li>
                <li class=""><a href="{{ url('admin/publicaciones/'.$publicaciones->id.'/imagen') }}" >Multimedia</a></li>
                <li class=""><a href="{{ url('admin/publicaciones/'.$publicaciones->id.'/atributos') }}" >Atributos</a></li>
            </ul>
            <div class="box-header with-border">
                <h3 class="box-title">Editar Productos</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{ url('admin/publicaciones/'.$publicaciones->id) }}" method="post">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <div class="box-body">
                    @php
                        if ($publicaciones->estado == 'activo'){
                            $activo = 'active';
                            $checkedyes = 'checked';
                            }
                        else{
                            $checkedyes = '';
                            $activo = '';
                            }

                        if ($publicaciones->estado == 'inactivo'){
                            $inactivo = 'active';
                            $checkedno = 'checked';
                            }
                        else{
                            $inactivo = '';
                            $checkedno = '';
                            }
                    @endphp

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Estado</label>
                        <div class="col-sm-10">
                            <div class="btn-group input-group" data-toggle="buttons">
                                <label class="btn btn-primary {{ $activo }}">
                                    <input type="radio" value="activo" name="estado" {{$checkedyes}}>Activo</label>
                                <label class="btn btn-default {{ $inactivo }}">
                                    <input type="radio" value="inactivo" name="estado" {{$checkedno}}>Inactivo</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="titulo" class="col-sm-2 control-label">Titulo</label>

                        <div class="col-sm-10">
                            <input type="text" required name="titulo" class="form-control" id="titulo" placeholder="Titulo" value="{{ $publicaciones->titulo }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tipo_moneda" class="col-sm-2 control-label">Moneda</label>

                        <div class="col-sm-10">
                            <select name="tipo_moneda" id="tipo_moneda" class="form-control selectmoneda" required>
                                <option value="{{$publicaciones->tipo_moneda}}">
                                    @if($publicaciones->tipo_moneda == 1)
                                        Peso Argentino
                                    @else
                                        Dolar
                                        @endif
                                </option>
                                <option value="1">Peso Argentino</option>
                                <option value="2">Dolar</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="precio" class="col-sm-2 control-label">Precio</label>

                        <div class="col-sm-10">
                            <input type="text" required name="precio" class="form-control" id="precio" placeholder="precio" value="{{ $publicaciones->precio }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="col-sm-2 control-label">Descripcion</label>

                        <div class="col-sm-10">
                            <!--<input type="text" required name="descripcion" class="form-control" id="descripcion" placeholder="Descripcion" value="{{ $publicaciones->descripcion }}">-->
                            <textarea name="descripcion" id="descripcion" cols="30" rows="5" class="form-control" placeholder="Descripcion">{{ $publicaciones->descripcion }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="id_padre" class="col-sm-2 control-label">Categorias</label>

                        <div class="col-sm-10">
                            <select name="id_categoria[]" required id="id_padre" class="form-control select2" multiple="multiple" style="width: 100%" >
                                @php($select = 0)
                                @foreach($categorias as $cate)
                                    @foreach($publicaciones->publicacionCategoria as $categoria)
                                        @if($categoria->nombre == $cate->nombre)
                                            @php($select = 1)
                                            @break
                                        @else
                                            @php($select = 0)
                                        @endif
                                    @endforeach
                                    @if($select == 1)
                                        <option value="{{ $cate->id }}" selected>{{ $cate->nombre }}</option>
                                        @else
                                            <option value="{{ $cate->id }}">{{ $cate->nombre }}</option>
                                        @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ url('admin/publicaciones') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary pull-right">Actualizar</button>
                </div>
                <!-- /.box-footer -->
            </form>

            <form action="{{ url('admin/publicaciones/'.$publicaciones->id) }}" method="post">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <div class="box-footer">
                    <button type="submit" class="btn btn-danger ">Eliminar</button>
                </div>
            </form>
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
