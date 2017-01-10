@extends('layouts.app')

@section('htmlheader_title', 'Usuarios - Ingresar')

@section('contentheader_title', 'Ingresar Usuarios')

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
                    <p class="login-box-msg">{{ trans('adminlte_lang::message.registermember') }}</p>
                    <form action="{{ url('admin/usuarios') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}"/>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" placeholder="Apellido" name="apellido" value="{{ old('apellido') }}"/>
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" placeholder="{{ trans('adminlte_lang::message.email') }}" name="email" value="{{ old('email') }}"/>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.retrypepassword') }}" name="password_confirmation"/>
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