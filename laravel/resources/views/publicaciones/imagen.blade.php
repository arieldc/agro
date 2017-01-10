@extends('layouts.app')

@section('htmlheader_title', 'Publicaciones - Editar Galeria')

@section('contentheader_title', 'Editar Galeria Publicacion')

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
                    <li class="active"><a href="{{ url('admin/publicaciones/'.$publicaciones->id.'/imagen') }}" >Multimedia</a></li>
                    <li class=""><a href="{{ url('admin/publicaciones/'.$publicaciones->id.'/atributos') }}" >Atributos</a></li>
                </ul>
                <form action="" method="post">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar Galeria Publicacion: {{ $publicaciones->titulo }}</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="ruta" class="control-label">Imagenes</label>
                        <input id="file-1" type="file" multiple=true class="file-loading" name="ruta[]" value="Ingrese una Imagen">
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        var imagenes = [
                @foreach ($imagenes as $img)
            [ "http://agrofans.com/{{ $img->ruta }}"],
            @endforeach
        ];

        var configPrew = [
          @foreach($imagenes as $img)
                {url: "#", key: "{{ $img->id }}", extra: { _token: "{{ csrf_token() }}", ruta: "{{ $img->ruta }}", _method: "DELETE" } },
                @endforeach
        ];

        $("#file-1").fileinput({
            language: 'es',
            uploadUrl: "#", // you must set a valid URL here else you will get an error
            uploadAsync: true,
            showUpload: true,
            initialPreviewFileType: 'image',
            allowedFileExtensions : ['jpg', 'png','gif', 'jpeg'],
            initialPreview: imagenes,
            initialPreviewAsData: true,
            validateInitialCount: true,
            overwriteInitial: false,
            maxFileSize: 1000,
            //maxFilesNum: 10,
            maxFileCount: 5,
            fileActionSettings:{
                showUpload: true
                //showRemove: false
            },
            //resizeImage: true,
            //maxImageWidth: 500,
            //maxImageHeight: 500,
            //resizePreference: 'width',
            uploadExtraData: {
                _token: "{{csrf_token()}}",
                id_publicacion: "{{ $publicaciones->id }}"
            },
            initialPreviewConfig: configPrew,
            browseOnZoneClick: true
        });
    </script>
@endsection