@extends('layouts.app')

@section('htmlheader_title', 'Categorias - Editar')

@section('contentheader_title', 'Editar Categorias')

@section('contentheader_description', '')

@section('cant-content-header')
    {{ $todasCategoria->count() }}
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
        <div class="col-md-12">
            @include('errors.errors')

            <!-- Horizontal Form -->
            <div class="box box-primary">
                <ul class="nav nav-tabs">
                    <li class=""><a href="{{ url('admin/categoria/'.$id.'/edit') }}" >General</a></li>
                    <li class="active"><a href="{{ url('admin/categoria/'.$id.'/atributos') }}" >Atributos Globales</a></li>
                </ul>
                <div class="tab-content">

                    <div class="box-header">
                        <h3 class="box-title">Atributos ==></h3>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-plus-circle"></i>
                        </button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Elemento</th>
                                <th>Estado</th>
                                <th>Orden</th>
                                <th>Accion</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allcategoriaId->categoriaAtributos as $categoriaAtributo)
                                <tr>
                                    <td>{{ $categoriaAtributo->nombre }}</td>
                                    <td>{{ $categoriaAtributo->elemento }}</td>
                                    <td>{{ $categoriaAtributo->requerido }}</td>
                                    <td>{{ $categoriaAtributo->orden }}</td>
                                    <td>

                                        <form action="{{ url('admin/categoria/'.$id.'/atributos/'.$categoriaAtributo->id) }}" method="post" >
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <a class="btn btn-warning btn-xs" href="atributos/{{ $categoriaAtributo->id }}/edit">Editar</a>
                                            <button type="submit" class="btn btn-danger btn-xs">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Elemento</th>
                                <th>Estado</th>
                                <th>Orden</th>
                                <th>Accion</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>




                    <!-- /.tab-pane -->
                    <div class="tab-pane active" id="tab_2">


                    </div>

                </div>

            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Atributos</h4>
                </div>
                <div class="modal-body">

                    <form action="{{ url('admin/categoria/'.$id.'/atributos/addAtributos') }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="id_padre" class="col-sm-2 control-label">Atributos</label>

                                <div class="col-sm-10">
                                    <select name="atributos" id="id_padre" class="form-control select2"
                                            style="width: 100%">
                                        <option value="nuevo" selected="selected">-- Nuevo Atributo --</option>
                                        @foreach($todosAtributos as $atributo)
                                            <option value="{{ $atributo->id }}">{{ $atributo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group submit-atributos">
                                <label class="col-sm-2 control-label">Estado</label>
                                <div class="col-sm-10">
                                    <div class="btn-group input-group" data-toggle="buttons">
                                        <label class="btn btn-primary active">
                                            <input type="radio" value="activo" name="estado"
                                                   checked>Activo</label>
                                        <label class="btn btn-default">
                                            <input type="radio" value="inactivo" name="estado">Inactivo</label>
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer submit-atributos">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary pull-right">Agregar</button>
                            </div>
                        </div>
                    </form>


                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal form-atr" action="{{  url('admin/categoria/'.$id).'/atributos' }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Estado</label>
                                <div class="col-sm-10">
                                    <div class="btn-group input-group" data-toggle="buttons">
                                        <label class="btn btn-primary active">
                                            <input type="radio" value="activo" name="estado"
                                                   checked>Activo</label>
                                        <label class="btn btn-default">
                                            <input type="radio" value="inactivo" name="estado">Inactivo</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Requerido</label>
                                <div class="col-sm-10">
                                    <div class="btn-group input-group" data-toggle="buttons">
                                        <label class="btn btn-primary active">
                                            <input type="radio" value="1" name="requerido" checked>Si</label>
                                        <label class="btn btn-default">
                                            <input type="radio" value="2" name="requerido">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nombre" class="col-sm-2 control-label">Nombre</label>

                                <div class="col-sm-10">
                                    <input type="text" name="nombre" class="form-control" id="nombre"
                                           placeholder="Nombre" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_padre" class="col-sm-2 control-label">Tipo de Elemento</label>

                                <div class="col-sm-10">
                                    <select name="elemento" id="id_padre" class="form-control select2"
                                            style="width: 100%" required>
                                        <option></option>
                                        <option value="input">input</option>
                                        <option value="textarea">textarea</option>
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
                                        <tr>
                                            <td>
                                                <input type="text" name="vista[0][value]" id="valor_vista" class="form-control"
                                                       placeholder="Ingrese Valor Vista" required>
                                            </td>
                                            <td>
                                                <div class="btn-group input-group" data-toggle="buttons">
                                                    <label class="btn btn-primary active">
                                                        <input type="radio" value="activo" name="vista[0][estado]"
                                                               checked>Activo</label>
                                                    <label class="btn btn-default">
                                                        <input type="radio" value="inactivo" name="vista[0][estado]">Inactivo</label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-danger"><i
                                                            class="fa fa-minus-circle"></i></a>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th><a class="btn btn-primary addAtr"><i class="fa fa-plus-circle"></i></a>
                                            </th>
                                        </tr>
                                        </tfoot>

                                    </table>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="orden" class="col-sm-2 control-label">Orden</label>

                                <div class="col-sm-10">
                                    <input type="number" name="orden" class="form-control" id="orden"
                                           placeholder="Introduce orden" required>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary pull-right">Agregar</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>


                </div>
                <!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>-->
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <!-- Select2 -->
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
            $(".elemto-table").hide();
        });

        //$(".elemto-table").hide();
        //$(".form-atr").hide();
        $('.submit-atributos').hide('slow');
        $('.addAtr').hide('slow');

        $("select[name=atributos]").change(function () {
           $select = $(this).val();
            switch ($select){
                case "nuevo":
                    $(".form-atr").show('slow');
                        $('.submit-atributos').hide('slow');
                    break;
                default:
                    $(".form-atr").hide('slow');
                        $('.submit-atributos').show('slow');
                    break;
            }
        });

        $("select[name=elemento]").change(function () {
            $select = $(this).val();

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
                    $('.addAtr').hide('slow');
                    $("#valor_vista").prop('required', false);
                    break
            }
        });
        var contador = 0;

        $(document).on('click', '.addAtr', function () {
            contador++;
            $('.allAtr').append('<tr><td><input type="text" required name="vista['+contador+'][value]" id="valor_vista" class="form-control" placeholder="Ingrese Valor Vista"></td><td><div class="btn-group input-group" data-toggle="buttons"><label class="btn btn-primary active"><input type="radio" value="activo" name="vista['+contador+'][estado]" checked >Activo</label><label class="btn btn-default"><input type="radio" value="inactivo" name="vista['+contador+'][estado]" >Inactivo</label></div></td><td><a class="btn btn-danger delAtr"><i class="fa fa-minus-circle"></i></a></td></tr>');
        });

        $(document).on('click', '.delAtr', function () {
            var parent = $(this).parents().get(1);
            $(parent).remove();
        });


    </script>
@endsection