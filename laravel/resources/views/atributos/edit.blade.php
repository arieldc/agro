@extends('layouts.app')

@section('htmlheader_title', 'Atributos - Editar')

@section('contentheader_title', 'Editar Atributos')

@section('contentheader_description', '')

@section('cant-content-header')
    {{ $atributos->count() }}
@endsection

@section('title-content-header', ' Ingresar Atributos')
@section('title2-content-header', 'Listar Atributos')

@section('url-content-header-create')
    {{ url('admin/atributo/create') }}
@endsection
@section('url-list-content-header')
    {{ url('admin/atributo') }}
@endsection


@section('main-content')
@include('layouts.partials.maincontentheader')
<div class="row">
<div class="col-md-9">
    @include('errors.errors')
    <!-- Horizontal Form -->
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Ingresar Atributos</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{ url($urlActualizar) }}" method="post">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            @php
                if($atributos->requerido == 1){
                        $activeyes = 'active';
                        $checkedyes = 'checked';
                        }
                else{
                    $activeyes = '';
                    $checkedyes = '';
                    }

                if($atributos->requerido == 2){
                    $activeno = 'active';
                    $checkedno = 'checked';
                }
                else{
                    $activeno = '';
                    $checkedno = '';
                }
            @endphp

            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label ">Requerido</label>
                    <div class="col-sm-10">
                        <div class="btn-group input-group" data-toggle="buttons">
                            <label class="btn btn-primary {{ $activeyes }}">
                                <input type="radio" value="1" name="requerido" {{ $checkedyes }} id="option1">Si</label>
                            <label class="btn btn-default {{ $activeno }}">
                                <input type="radio" value="2" name="requerido" {{ $checkedno }} id="option3">No</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nombre" class="col-sm-2 control-label">Nombre</label>

                    <div class="col-sm-10">
                        <input type="text" value="{{ $atributos->nombre }}" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="id_padre" class="col-sm-2 control-label">Elemento</label>

                    <div class="col-sm-10">
                        <select name="elemento" id="id_padre" class="form-control select2" style="width: 100%" required>
                            <option value="{{ $atributos->elemento }}" selected>{{ $atributos->elemento }}</option>
                            <option value="input">input</option>
                            <option value="textarea">textarea
                            <option value="selectbox">selectbox</option>
                            <option value="multiselectbox">multiselectbox</option>
                            <option value="radio">radio</option>
                            <option value="checkbox">checkbox</option>
                            <option value="checkboxgroup">checkboxgroup</option>
                            <option value="file">file</option>
                            <option value="hidden">hidden</option>
                        </select>
                    </div>
                </div>

                <div class="form-group elemto-table">
                    <label class="col-sm-2"></label>
                    <div class="col-sm-10">
                        <table class="table table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th class="col-sm-6">Valor Vista</th>
                                <th class="col-sm-6">Estado</th>
                                <th class="col-sm-2">Action</th>
                            </tr>
                            </thead>
                            <tbody class="allAtr">
                            @php $i = 0; @endphp
                            @foreach($atributos->atrGlobalValores as $atrGlobValor)
                                @php
                                    if ($atrGlobValor->estado == 'activo'){
                                        $activo = 'active';
                                        $checked = 'checked';
                                    }
                                    else{
                                        $activo = '';
                                        $checked = '';
                                    }

                                    if ($atrGlobValor->estado == 'inactivo'){
                                        $inactivo = 'active';
                                        $nochecked = 'checked';
                                    }
                                    else{
                                        $inactivo = '';
                                        $nochecked = '';
                                    }
                                @endphp
                                <tr>
                                    <td>
                                        <input type="text" name="vista[{{ $i }}][value]" id="valor_vista" class="form-control" placeholder="Ingrese Valor Vista" required value="{{ $atrGlobValor->value_vista }}">
                                    </td>
                                    <td>
                                        <div class="btn-group input-group" data-toggle="buttons">
                                            <label class="btn btn-primary {{ $activo }}">
                                                <input type="radio" value="activo" name="vista[{{$i}}][estado]" {{ $checked }}>Activo</label>
                                            <label class="btn btn-default {{ $inactivo }}">
                                                <input type="radio" value="inactivo" name="vista[{{$i}}][estado]" {{ $nochecked }}>Inactivo</label>
                                        </div>
                                    </td>
                                    <td>
                                        <!--<a class="btn btn-danger delAtr"><i class="fa fa-minus-circle"></i></a>-->
                                    </td>
                                </tr>

                                @php($i++)
                                @endforeach
                                <input type="hidden" name="id" value="{{  $i }}" class="contador">
                            <!--<tr>
                                <td>
                                    <input type="text" name="vista[0][value]" id="" class="form-control" placeholder="Ingrese Valor Vista">
                                </td>
                                <td>
                                    <div class="btn-group input-group" data-toggle="buttons">
                                        <label class="btn btn-primary active">
                                            <input type="radio" value="activo" name="vista[0][estado]" checked >Activo</label>
                                        <label class="btn btn-default">
                                            <input type="radio" value="inactivo" name="vista[0][estado]" >Inactivo</label>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-danger"><i class="fa fa-minus-circle"></i></a>
                                </td>
                            </tr>-->
                            </tbody>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th><a class="btn btn-primary addAtr"><i class="fa fa-plus-circle"></i></a></th>
                            </tr>
                            </tfoot>

                        </table>

                    </div>
                </div>

                <div class="form-group">
                    <label for="orden" class="col-sm-2 control-label">Orden</label>

                    <div class="col-sm-10">
                        <input type="number" value="{{ $atributos->orden }}" name="orden" class="form-control" id="orden" placeholder="Introduce orden" required>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{ url($urlCancel) }}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary pull-right">Actualizar</button>
            </div>
            <!-- /.box-footer -->
        </form>

        <form action="{{ url('admin/atributo/'.$atributos->id) }}" method="post" class="form-horizontal">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <div class="box-footer">
                <button type="submit" class="btn btn-danger">Eliminar</button>
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
            $('.addAtr').hide('slow');
            $select = $("select[name=elemento]").val();
            atributoSelect($select);
        });

        //$(".elemto-table").hide();

        $("select[name=elemento]").change(function () {
            $select = $(this).val();
            atributoSelect($select);

            /*switch ($select){
                case "selectbox":
                    //$(".elemto-table").show('slow');
                    $('.addAtr').show('slow');
                    $("#valor_vista").prop('required', true);
                    break;
                case "multiselectbox":
                    //$(".elemto-table").show('slow');
                    $('.addAtr').show('slow');
                    $("#valor_vista").prop('required', true);
                    break;
                case "radio":
                    //$(".elemto-table").show('slow');
                    $('.addAtr').show('slow');
                    $("#valor_vista").prop('required', true);
                    break;
                case "checkboxgroup":
                    //$(".elemto-table").show('slow');
                    $('.addAtr').show('slow');
                    $("#valor_vista").prop('required', true);
                    break;
                default:
                    //$(".elemto-table").hide('slow');
                    $('.delAtr').parents('tr').remove();
                    $("#valor_vista").prop('required', false);
                    $('.addAtr').hide('slow');
                    break
            }*/
        });

        function atributoSelect($select) {

            switch ($select){
                case "selectbox":
                    $(".elemto-table").show('slow');
                    $('.addAtr').show('slow');
                    $("#valor_vista").prop('required', true);
                    break;
                case "multiselectbox":
                    $(".elemto-table").show('slow');
                    $('.addAtr').show('slow');
                    $("#valor_vista").prop('required', true);
                    break;
                case "radio":
                    $(".elemto-table").show('slow');
                    $('.addAtr').show('slow');
                    $("#valor_vista").prop('required', true);
                    break;
                case "checkboxgroup":
                    $(".elemto-table").show('slow');
                    $('.addAtr').show('slow');
                    $("#valor_vista").prop('required', true);
                    break;
                default:
                    $(".elemto-table").hide('slow');
                    $('.delAtr').parents('tr').remove();
                    $("#valor_vista").prop('required', false);
                    $('.addAtr').hide('slow');
                    break
            }

        }

        var contador = $('.contador').val();

        $(document).on('click', '.addAtr', function () {
            $('.allAtr').append('<tr><td><input type="text" required name="vista['+contador+'][value]" id="valor_vista" class="form-control" placeholder="Ingrese Valor Vista"></td><td><div class="btn-group input-group" data-toggle="buttons"><label class="btn btn-primary active"><input type="radio" value="activo" name="vista['+contador+'][estado]" checked >Activo</label><label class="btn btn-default"><input type="radio" value="inactivo" name="vista['+contador+'][estado]" >Inactivo</label></div></td><td><a class="btn btn-danger delAtr"><i class="fa fa-minus-circle"></i></a></td></tr>');
            contador++;
        });

        $(document).on('click', '.delAtr', function () {
            var parent = $(this).parents().get(1);
            $(parent).remove();
        });


    </script>
@endsection