@extends('layouts.app')

@section('htmlheader_title', 'Usuarios - Editar')

@section('contentheader_title', 'Editar Usuarios')

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
    <div class="col-md-9">
        @include('errors.errors')
        <!-- Horizontal Form -->
            <div class="register-box">

                <div class="register-box-body">
                    <p class="login-box-msg">Editar Usuarios</p>
                    <form action="{{ url('admin/usuarios/'.$usuario->id) }}" method="post">
                        {{ method_field('PATCH') }}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ $usuario->name }}"/>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" placeholder="Apellido" name="apellido" value="{{ $usuario->apellido }}"/>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" placeholder="{{ trans('adminlte_lang::message.email') }}" name="email" value="{{ $usuario->email }}"/>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password" value="{{ $usuario->password }}"/>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.retrypepassword') }}" name="password_confirmation" value="{{ $usuario->password }}"/>
                            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-xs-push-1">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('adminlte_lang::message.register') }}</button>
                            </div><!-- /.col -->
                        </div>
                    </form>
                </div><!-- /.form-box -->
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
