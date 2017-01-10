@extends('layouts.app')

@section('htmlheader_title', 'Publicaciones - Ingresar')

@section('contentheader_title', 'Ingresar Publicaciones')

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
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ingresar Publicaciones</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{ url('admin/publicaciones') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Estado</label>
                        <div class="col-sm-10">
                            <div class="btn-group input-group" data-toggle="buttons">
                                <label class="btn btn-primary active">
                                    <input type="radio" value="activo" name="estado" checked>Activo</label>
                                <label class="btn btn-default">
                                    <input type="radio" value="inactivo" name="estado" >Inactivo</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Titulo</label>

                        <div class="col-sm-10">
                            <input type="text" required name="titulo" class="form-control" id="titulo" placeholder="Titulo" value="{{old('titulo')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tipo_moneda" class="col-sm-2 control-label">Moneda</label>

                        <div class="col-sm-10">
                            <select name="tipo_moneda" id="tipo_moneda" class="form-control selectmoneda" required>
                                <option></option>
                                <option value="1">Peso Argentino</option>
                                <option value="2">Dolar</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="precio" class="col-sm-2 control-label">Precio</label>

                        <div class="col-sm-10">
                            <input type="number" required name="precio" class="form-control" id="precio" placeholder="Introduce precio" value="{{old('precio')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descripcion" class="col-sm-2 control-label">Descripcion</label>

                        <div class="col-sm-10">
                            <!--<input type="text" required name="descripcion" class="form-control" id="descripcion" placeholder="Descripcion" value="{{old('descripcion')}}">-->
                            <textarea name="descripcion" id="descripcion"  rows="5" required class="form-control" placeholder="Descripcion">{{ old('descripcion') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_padre" class="col-sm-2 control-label">Categorias</label>

                        <div class="col-sm-10">
                            <select name="id_categoria[]" id="id_padre" class="form-control select2" multiple="multiple" style="width: 100%" required>
                                <option value=""></option>

                                @foreach($categorias as $cat)
                                    @if($cat->id_padre == 0)
                                        <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                    @endif
                                    @foreach($categorias as $cat2)
                                        @if($cat2->id == $cat->id_padre)
                                            <option value="{{ $cat->id }}">{{$cat2->nombre.' > '.$cat->nombre }}</option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ruta" class="col-sm-2 control-label">Imagenes</label>

                        <div class="col-sm-10">
                            <input id="file-1" type="file" multiple class="file" name="ruta[]" value="Ingrese una Imagen" required>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ url('admin/publicaciones') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                </div>
                <!-- /.box-footer -->
            </form>

        </div>
    </div>
        </div>
@endsection
@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('/plugins/select2/select2.full.min.js') }}"></script>

    <script>
        $("#file-1").fileinput({
            language: 'es',
            uploadUrl: 'publicaciones', // you must set a valid URL here else you will get an error
            uploadAsync: false,
            initialPreviewFileType: 'image',
            allowedFileExtensions : ['jpg', 'png','gif'],
            //overwriteInitial: false,
            maxFileSize: 1000,
            //maxFilesNum: 10,
            maxFileCount: 5,
            showUpload: false,
            fileActionSettings:{
                showUpload: false
                //showRemove: false
            },
            browseOnZoneClick: true
            //allowedFileTypes: ['image', 'video', 'flash'],
            /*slugCallback: function(filename) {
                return filename.replace('(', '_').replace(']', '_');
            }*/
        });

        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
            $(".selectmoneda").select2();

            $(".select2").change(function () {


            });

        });
    </script>
@endsection