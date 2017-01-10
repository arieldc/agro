@extends('layouts.app')

@section('htmlheader_title')
    Responder el correo
@endsection

@section('contentheader_title', 'Mensajes')


@section('main-content')
    <div class="row">

        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Responder Mensaje</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <input class="form-control" placeholder="Para:" value="{{ $contacto->nombre }} {{ $contacto->apellido }}">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Email:" value="{{ $contacto->email }}">
                    </div>
                    <div class="form-group">
                    <textarea id="compose-textarea" class="form-control" style="height: 300px">

                    </textarea>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button>
                    </div>
                    <a type="reset" class="btn btn-default" href="{{ url('admin/mensajes/'.$contacto->id) }}"><i class="fa fa-times"></i> Cancelar</a>
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
