@extends('layouts.app')

@section('htmlheader_title', 'Categorias - Lista')

@section('contentheader_title', 'Ingresar Categorias')

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

    <div class="col-md-9">
        <!-- Horizontal Form -->
        @include('errors.errors')
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Ingresar Categorias</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{ url('admin/categoria') }}" method="post">
                {{ csrf_field() }}
                <div class="box-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Estado</label>
                        <div class="col-sm-10">
                            <div class="btn-group input-group" data-toggle="buttons">
                                <label class="btn btn-primary active">
                                    <input type="radio" value="activa" name="estado" required checked >Activo</label>
                                <label class="btn btn-default">
                                    <input type="radio" value="inactiva" name="estado" required >Inactivo</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Nombre</label>

                        <div class="col-sm-10">
                            <input type="text" required name="nombre" class="form-control" id="nombre" placeholder="Nombre" value="{{ old('nombre') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_padre" class="col-sm-2 control-label">Categoria Padre</label>

                        <div class="col-sm-10">
                            <select name="id_padre" id="id_padre" class="form-control select2">
                                <option value="0">N/S</option>
                                @foreach($categoria as $cat)
                                    @if($cat->id_padre == 0)
                                        <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                    @endif
                                    @foreach($categoria as $cat2)
                                        @if($cat2->id == $cat->id_padre)
                                                <option value="{{ $cat->id }}">{{$cat2->nombre.' > '.$cat->nombre }}</option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="orden" class="col-sm-2 control-label">Orden</label>

                        <div class="col-sm-10">
                            <input type="number" required name="orden" class="form-control" id="orden" placeholder="Introduce orden" value="{{ old('orden') }}">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ url('admin/categoria') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('/plugins/select2/select2.full.min.js') }}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2({
                placeholder: "Digite Categoria Padre"
            });
        });
    </script>
@endsection