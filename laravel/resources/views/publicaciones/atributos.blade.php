@extends('layouts.app')

@section('htmlheader_title', 'Publicaciones - Editar Atributos')

@section('contentheader_title', 'Editar Atributos Publicacion')

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
            <div class="box box-info">
                <ul class="nav nav-tabs">
                    <li class=""><a href="{{ url('admin/publicaciones/'.$publicaciones->id.'/edit') }}" >General</a></li>
                    <li class=""><a href="{{ url('admin/publicaciones/'.$publicaciones->id.'/imagen') }}" >Multimedia</a></li>
                    <li class="active"><a href="{{ url('admin/publicaciones/'.$publicaciones->id.'/atributos') }}" >Atributos</a></li>
                </ul>

                <div class="box-header with-border">
                    <h3 class="box-title">Atributos:</h3>
                </div>
                <!--<form class="form-horizontal" method="get">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="categoria" class="col-sm-2 control-label">Seleccioné la Categoria</label>

                            <div class="col-sm-10">
                                <select name="categoria" id="categoria" class="form-control" >
                                    <option></option>
                                    @foreach($publicaciones->publicacionCategoria as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="loading-img">
                    </div>

                    <div class="box-body atributos">
                        <div class="form-group">
                            <label for="atributos" class="col-sm-2 control-label">Seleccioné la Atributos</label>

                            <div class="col-sm-10">
                                <select name="atributos" id="atributos" class="form-control" >

                                </select>
                            </div>
                        </div>
                    </div>
                </form>-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Agregar Atributos</h3>
                </div>
                <div class="loading-img2">
                </div>
                <div class="box-body atributosValore">
                    <div>
                        <form action="atributos/addAtr2" method="post" class="form-horizontal" enctype='multipart/form-data'>
                            {{ csrf_field() }}
                            @foreach($atribGlobales as $atributos)
                                <div class='box-body'>
                                    <div class='form-group'>
                                        <label for='value_vista' class='col-sm-2 control-label'>{{ $atributos->nombre }}</label>
                                        <input type='hidden' name='{{ $atributos->id }}' value='{{ $atributos->id }}'>
                                        @php($valor = "")
                                        @foreach($publicaciones->publicacionAtributos as $atributos2)
                                            @if($atributos2->nombre == $atributos->nombre)
                                                <!--{{ $atributos2->pivot->valor_atributo }}-->
                                                @php($valor = $atributos2->pivot->valor_atributo)
                                                @endif
                                        @endforeach

                                        <div class='col-sm-10'>
                                            @if($atributos->elemento == 'input')
                                                <input type='text' name='{{ $atributos->id }}[]' id='value_vista' class='form-control'
                                                   value='{{$valor}}' >
                                                @elseif($atributos->elemento == 'textarea')
                                                <textarea name='{{ $atributos->id }}[]' class='form-control' id="value_vista" >{{$valor}}</textarea>
                                                @elseif($atributos->elemento == 'selectbox')
                                                <select name='{{ $atributos->id }}[]' class='form-control' id="value_vista" >
                                                    <option value="{{$valor}}">{{$valor}}</option>
                                                    @foreach($atributos->atrGlobalValores as $valores)
                                                        <option value="{{$valores->value_vista}}">{{$valores->value_vista}}</option>
                                                        @endforeach
                                                </select>
                                                @elseif($atributos->elemento == 'multiselectbox')
                                                <select name='{{ $atributos->id }}[]' multiple='multiple' class='form-control select2' id="value_vista" >
                                                    @foreach($publicaciones->publicacionAtributos as $atributos2)
                                                        @if($atributos2->nombre == $atributos->nombre)
                                                            <option value="{{ $atributos2->pivot->valor_atributo }}" selected>{{ $atributos2->pivot->valor_atributo }}</option>
                                                        @endif
                                                    @endforeach

                                                    @foreach($atributos->atrGlobalValores as $valores)
                                                        <option value="{{$valores->value_vista}}">{{$valores->value_vista}}</option>
                                                    @endforeach
                                                </select>
                                                @elseif($atributos->elemento == 'radio')
                                                    @foreach($atributos->atrGlobalValores as $valores)
                                                        @foreach($publicaciones->publicacionAtributos as $atributos2)
                                                            @if($atributos2->nombre == $atributos->nombre)
                                                                @if($atributos2->pivot->valor_atributo == $valores->value_vista)
                                                                    @php($checked = "checked")
                                                                @else
                                                                    @php($checked = "")
                                                                @endif
                                                            @endif
                                                        @endforeach

                                                        <label class='form-control'>
                                                            <input type='radio' name='{{ $atributos->id }}[]' value='{{$valores->value_vista}}' {{$checked}}> {{$valores->value_vista}}
                                                        </label>
                                                    @endforeach
                                                @elseif($atributos->elemento == 'checkbox')
                                                <div class="checkbox-group required">
                                                    @foreach($atributos->atrGlobalValores as $valores)
                                                        @foreach($publicaciones->publicacionAtributos as $atributos2)
                                                            @if($atributos2->nombre == $atributos->nombre)
                                                                @if($atributos2->pivot->valor_atributo == $valores->value_vista)
                                                                    @php($checked = "checked")
                                                                    @break
                                                                @else
                                                                    @php($checked = "")
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        <label class='form-control'>
                                                            <input type='checkbox' name='{{ $atributos->id }}[]' value='{{$valores->value_vista}}' {{$checked}}> {{$valores->value_vista}}
                                                        </label>
                                                    @endforeach
                                                </div>
                                                @elseif($atributos->elemento == 'checkboxgroup')
                                                <div class="checkbox-group required">
                                                    @foreach ($atributos->atrGlobalValores as $valores)
                                                        @foreach($publicaciones->publicacionAtributos as $atributos2)
                                                            @if($atributos2->nombre == $atributos->nombre)
                                                                @if($atributos2->pivot->valor_atributo == $valores->value_vista)
                                                                    @php($checked = "checked")
                                                                    @break
                                                                @else
                                                                    @php($checked = "")
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        <label class='form-control'>
                                                            <input type='checkbox' name='{{ $atributos->id }}[]' value='{{$valores->value_vista}}' {{$checked}}> {{$valores->value_vista}}
                                                        </label>
                                                    @endforeach
                                                </div>
                                                @elseif($atributos->elemento == 'file')
                                                <input type='file' name='{{ $atributos->id }}[]' class='form-control'>
                                                @elseif($atributos->elemento == 'hidden')

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                <div class='box-footer'>
                                    <!--<a href='' class='btn btn-default'>Cancel</a>-->
                                    <button type='submit' class='btn btn-primary pull-right'>Guardar</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Listar Atributos</h3>
                </div>
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-hover">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Elemento</th>
                            <th>Valores</th>
                            <th>Accion</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($publicaciones->publicacionAtributos as $atributos)
                        <tr>
                            <td>{{ $atributos->nombre }}</td>
                            <td>{{ $atributos->elemento }}</td>
                            <td>{{ $atributos->pivot->valor_atributo }}</td>
                            <td>
                                <div class="btn-group">
                                    <a type="button" class="btn btn-default btn-sm" href="{{ url('admin/publicaciones/'.$publicaciones->id.'/atributos/'.$atributos->pivot->id.'/borrar') }}" data-toggle="tooltip" title="Borrar"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Elemento</th>
                            <th>Valores</th>
                            <th>Accion</th>
                        </tr>
                        </tfoot>
                    </table>


                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('/plugins/select2/select2.full.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();
            $("#example1").DataTable({
                "language": {
                    "url": "http://agrofans.com/plugins/datatables/lang/Spanish.json"
                }
            });
        });

        $('.atributos').hide();

        $("select[name=categoria]").change(function () {
            $select = $(this).val();
            //alert($select);
            $('.loading-img').show();
            $('.loading-img').html('<p class="loading"><img src="/img/loading-bar.gif" /></p>');
            $('.atributos').hide();
            $.ajax({
                type: "GET",
                url: "atributos/"+$select
                //data: { idCategoria : $select }
            }).done(function(data){
                $('.loading-img').hide();
                $('.atributos').show();
                $('#atributos').html(data);
                $('.pruebas').html(data);
            });
        });

        $("select[name=atributos]").change(function () {
            $select = $(this).val();
            //alert($select);
            $('.loading-img2').show();
            $('.loading-img2').html('<p class="loading"><img src="/img/loading-bar.gif" /></p>');
            $('.atributosValore').hide();
            $.ajax({
                type: "GET",
                url: "atributos/valores/"+$select
                //data: { idCategoria : $select }
            }).done(function(data){
                $('.loading-img2').hide();
                $('.atributosValore').show();
                $('.atributosValore').html(data);
                $(".select2").select2();
                var requiredCheckboxes = $(".required input:checkbox");
                //alert(requiredCheckboxes.val());
                requiredCheckboxes.click(function(){
                    //alert(requiredCheckboxes.val());
                    if(requiredCheckboxes.is(':checked')) {
                        requiredCheckboxes.removeAttr('required');
                    } else {
                        requiredCheckboxes.attr('required', 'required');
                    }
                });
            });
        });
    </script>
@endsection