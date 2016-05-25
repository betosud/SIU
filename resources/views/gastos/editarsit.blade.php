@extends('layouts.app')
@section('contenido')
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="col-md-10 col-lg-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Editar SIT</h3>
                </div>

                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ $error }}</div>
                    @endforeach
                @endif

                {{--{!! Form::open(array('url' => 'guardarsit', 'method' => 'post','class'=>'form-horizontal')) !!}--}}
                {!! Form::model($solicitud,['route' => ['actualizarsit',$solicitud->datossit->id], 'method' => 'PUT','class'=>'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::text('statuscomprobantes',67 ,['class'=>'hide']) !!}
                    {!! Form::text('enviooficinas','0' ,['class'=>'hide']) !!}
                    {!! Form::text('user_id',Auth::user()->id ,['class'=>'hide']) !!}
                    {!! Form::text('idsolicitud',$solicitud->datossit->idsolicitud ,['class'=>'hide']) !!}


                </div>


                <div class="form-group">
                    {!! Form::label('Referencia','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon glyphicon-file"></span>
                            </span>
                            {!! Form::text('id',$solicitud->datossit->id,['placeholder'=>'Numero de Referecnia','class'=>'form-control','readonly'=>'']) !!}

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('fecha','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class=' input-group'>
                            <span class="input-group-addon glyphicon glyphicon-calendar"></span>
                            {!! Form::text('fecha',$solicitud->datossit->fechadma,['placeholder'=>'Fecha','class'=>'date form-control','id'=>'date']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Solicitante','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class=' input-group'>
                            <span class="input-group-addon glyphicon glyphicon-user"></span>
                            {!! Form::text('solicitante',$solicitud->solicitante,['placeholder'=>'Nombre completo del solicitante','class'=>'form-control','id'=>'solicitante']) !!}
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('Pagable','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class=' input-group'>
                            <span class="input-group-addon glyphicon glyphicon-user"></span>
                            {!! Form::text('pagable',$solicitud->pagable,['placeholder'=>'Nombre completo','class'=>'form-control','id'=>'pagable']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('IFE','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class=' input-group'>
                            <span class="input-group-addon glyphicon glyphicon-credit-card"></span>
                            {!! Form::text('ife',$solicitud->ife,['placeholder'=>'Numero de Ife 13 digitos','class'=>'form-control','id'=>'ife']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('Correo','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class=' input-group'>
                            <span class="input-group-addon glyphicon glyphicon-envelope"></span>
                            {!! Form::text('mail',$solicitud->mail,['placeholder'=>'nombre@dominio.com','class'=>'form-control','id'=>'mail']) !!}
                        </div>
                    </div>
                </div>



                <div class="form-group">
                    {!! Form::label('Descripcion','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class=' input-group'>
                            <span class="input-group-addon glyphicon glyphicon-menu-hamburger"></span>
                            {!! Form::text('descripcion',$solicitud->descripcion,['placeholder'=>'Descripcion del Gasto','class'=>'form-control','id'=>'descripcion']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Cantidad','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class=' input-group'>
                            <span class="input-group-addon glyphicon glyphicon-usd"></span>
                            {!! Form::text('cantidad',$solicitud->cantidad,['placeholder'=>'Cantidad','class'=>'form-control','id'=>'cantidad']) !!}
                        </div>
                    </div>
                </div>



                <div class="form-group">
                    {!! Form::label('Organizacion','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon glyphicon glyphicon-th-large" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('organizacion', $combo['organizacion'],$solicitud->organizacion,['placeholder'=>'Selecciona Categoria','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('Tipo de pago','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon glyphicon glyphicon-th-large" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('tipopago', $combo['tipopago'],$solicitud->tipopago,['placeholder'=>'Selecciona Categoria','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('Categoria','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon glyphicon glyphicon-tasks" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('categoria', $categoria,$solicitud->datossit->categoria,['placeholder'=>'Selecciona Categoria','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Pte. Organizacion','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon glyphicon glyphicon-user" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('pteorganizacion', $lideres,$solicitud->datossit->pteorganizacion,['placeholder'=>'Selecciona Lider','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Obispado','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon glyphicon glyphicon-user" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('obispo', $lideres,$solicitud->datossit->obispo,['placeholder'=>'Selecciona Lider Obispado','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('Status','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon glyphicon glyphicon-tags" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('status', $status,$solicitud->datossit->status,['placeholder'=>'Selecciona Status','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>









                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">
                            Guardar
                        </button>
                        <a  class="btn btn-danger" role="button" data-toggle="modal" data-target="#salir">Cancelar</a>




                        <a tabindex="0" type="button" class="btn btn-info glyphicon glyphicon-print" data-toggle="popover" data-placement="right" title="Opciones de Impresion" data-trigger="focus"
                           data-content="<a href='/pdfsit/{!! $solicitud->id !!}/solicitud/descargar'>Solicitud</a><br> <a href='/pdfsit/{!! $solicitud->id !!}/sit/descargar'>Sit</a> <br><a href='/pdfsit/{!! $solicitud->id !!}/completo/descargar'>Completo</a>"></a>
                    </div>
                </div>


                {!! Form::close() !!}

            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="col-md-10 col-lg-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Archivos adjuntos</h3>
                </div>
                {{--<a  class="btn btn-success" role="button" data-toggle="modal" data-target="#uploadfile">Agregar</a>--}}


                <div class="panel-body">
                    @permission('add.archivosit')
                    <div class="btn-group">
                        <span data-toggle="tooltip" data-placement="rigth" title="Agregar Nuevo Archivo">
                        <a class="btn btn-success glyphicon glyphicon-plus" role="button" data-toggle="modal" data-target="#uploadfile"></a>
                            </span>
                    </div>
                    @endpermission
                    <div class="table-responsive">
                        <div class="discursos">
                            <table class="table table-bordered table-hover table-condensed clearfix">
                                <th data-field="id">Nombre</th>
                                <th data-field="descripcion">Descripcion</th>
                                <th data-field="tipo">Tipo</th>
                                <th data-field="acciones">Acciones</th>


                                @foreach($archivossit as $archivo)
                                    <tr data-id={!! $archivo->id !!} >
                                        <td>{!!$archivo->nombrearchivo !!}</td>
                                        <td>{!!$archivo->descripcion !!}</td>
                                        <td>{!!$archivo->tipo !!}</td>
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="Descargar Archivo">
                                            <a  class="btn btn-info glyphicon glyphicon-cloud-download" role="button" href={!! url('download?path='.public_path('archivos')."/".$archivo->rutaarchivo)!!}></a>
                                                </span>
                                            @permission('delete.filesit')
                                            <span data-toggle="tooltip" data-placement="top" title="Eliminar Archivo">
                                            <a  class="btn btn-danger glyphicon glyphicon-trash" role="button" data-toggle="modal" data-target="#eliminarfile{!! $archivo->id !!}"></a>
                                                </span>
                                            @endpermission
                                        </td>
                                @endforeach
                            </table>
                        </div>
                    </div>



            </div>
        </div>

    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="salir" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Si sale del modulo los cambios no se guardaran</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <a href="{!! route('sits') !!}" class="btn btn-success" role="button">Salir</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

        {{--modales eliminar acrchivos--}}
        @foreach($archivossit as $archivo)
            <div class="modal fade" tabindex="-1" role="dialog" id="eliminarfile{!! $archivo->id !!}" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Esta Seguro que desea eliminar el archivo <strong>{!! $archivo->nombrearchivo !!}</strong></h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                            <a href="{!! route('eliminararchivosit',$archivo->id ) !!}" class="btn btn-danger" role="button">Eliminar</a>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        @endforeach



    {{--modal upload file--}}
    <div class="modal fade" id="uploadfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Adjuntar Archivo</h4>
                </div>
                <div class="modal-body">
                    {{--<form class="form-group">--}}
                    {!! Form::open(['url' => 'guardararchivo','files' => true, 'method' => 'post'])  !!}

                    <div class="form-group">

                        {!! Form::text('idsolicitud',$solicitud->id,['placeholder'=>'Seleccione Fecha','class'=>'hide']) !!}
                    </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Nombre del Archivo:</label>
                            {!! Form::text('nombre',"",['placeholder'=>'Nombre del Archivo','class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Descripcion del Archivo:</label>
                            {!! Form::text('descripcion',"",['placeholder'=>'Descripcion','class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {{--<label for="recipient-name" class="control-label">Nombre del Archivo:</label>--}}
                        <label class="control-label">Selecciona Archivo</label>
                        {!! Form::file('archivo', $attributes = array()) !!}
                        </div>


                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">
                        Guardar
                    </button>

                    </form>
                </div>
                {{--<div class="modal-footer">--}}

                </div>
            </div>
        </div>
    </div>





@endsection

@section('scripts')
    {!! Html::script('js/quitaralerta.js') !!}
<script>

</script>
@endsection