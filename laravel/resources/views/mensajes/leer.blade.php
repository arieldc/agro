@extends('layouts.app')

@section('htmlheader_title')
    Leer el correo
@endsection

@section('contentheader_title', 'Mensajes')


@section('main-content')
    <div class="row">

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Leer el correo</h3>

                    <div class="box-tools pull-right">
                        <!--<a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Anterior"><i class="fa fa-chevron-left"></i></a>
                        <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Siguiente"><i class="fa fa-chevron-right"></i></a>-->
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-read-info">
                        <h3>{{$contacto->nombre }} {{ $contacto->apellido}}</h3>
                        <h5>From: {{ $contacto->email }}
                            Telf: {{ $contacto->telefono }}
                            <span class="mailbox-read-time pull-right">{{ $contacto->created_at }}</span></h5>
                    </div>
                    <!-- /.mailbox-read-info -->
                    <div class="mailbox-controls with-border text-center">
                        <div class="btn-group">
                            <a type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Borrar">
                                <i class="fa fa-trash-o"></i></a>
                            <!--<a type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Responder" href="{{ url('admin/mensajes/'.$contacto->id.'/responder') }}">
                                <i class="fa fa-reply"></i></a>-->
                        </div>
                        <!-- /.btn-group -->
                        <!--<button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Imprimir">
                            <i class="fa fa-print"></i></button>-->
                    </div>
                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                        <h3>{{ $contacto->publicacion->titulo }} ${{ $contacto->publicacion->precio }}</h3>
                        @php
                            $publicaciones = App\Tbl_publicaciones::find($contacto->publicacion->id);
                        @endphp
                        @foreach($publicaciones->publicacionImagen as $img)
                            <img src="../../{{ $img->ruta }}" class="img-responsive" style="background-size: cover" width="70px">
                            @break
                        @endforeach

                        <h4>Mensaje:</h4>
                        <p>{{ $contacto->descripcion }}</p>
                    </div>
                    <!-- /.mailbox-read-message -->
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <div class="pull-right">
                        <!--<a type="button" class="btn btn-default" href="{{ url('admin/mensajes/'.$contacto->id.'/responder') }}"><i class="fa fa-reply"></i> Responder</a>-->
                    </div>
                    <a type="button" class="btn btn-default" href="{{ url('admin/mensajes') }}"><i class="fa fa-times"></i> Cancelar</a>
                    <a type="button" class="btn btn-default" href="{{ url('admin/mensajes/'.$contacto->id.'/borrar') }}"><i class="fa fa-trash-o"></i> Borrar</a>
                    <!--<a type="button" class="btn btn-default"><i class="fa fa-print"></i> Imprimir</a>-->
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /. box -->
        </div>

    </div>
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
