@extends('layouts.app')
@section('contenido')
    <div class="container-fluid">
        <div class="col-md-10 col-lg-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Nueva Solicitud de Gasto</h3>
                </div>

                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ $error }}</div>
                    @endforeach
                @endif



                {!! Form::model($solicitud,['route' => ['actualizarsolicitud',$solicitud->id], 'method' => 'PUT','class'=>'form-horizontal']) !!}
<div class="form-group"></div>
                <div class="form-group">
                    {!! Form::label('Fecha','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='date'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            {!! Form::text('fecha',$solicitud->fechamda,['placeholder'=>'Seleccione Fecha','class'=>'form-control date','id'=>'date']) !!}

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Solicitante','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon glyphicon-user"></span>
                            </span>
                            {!! Form::text('solicitante',$solicitud->solicitante,['placeholder'=>'Nombre Completo','class'=>'form-control']) !!}

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('correo','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon glyphicon-envelope"></span>
                            </span>
                            {!! Form::text('mail',$solicitud->mail,['placeholder'=>'nombre@dominio.com','class'=>'form-control']) !!}

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Pagable','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon glyphicon-user"></span>
                            </span>
                            {!! Form::text('pagable',$solicitud->pagable,['placeholder'=>'Nombre Completo','class'=>'form-control']) !!}

                        </div>
                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('Identificacion','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon glyphicon-credit-card"></span>
                            </span>
                            {!! Form::text('ife',$solicitud->ife,['placeholder'=>'Numero de IFE 18 digitos','class'=>'form-control']) !!}

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Cantidad','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group' >
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon glyphicon-usd"></span>
                            </span>
                            {!! Form::text('cantidad',$solicitud->cantidad,['placeholder'=>'Monto del Gasto','class'=>'form-control']) !!}

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Descipcion','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group' >
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon glyphicon-th"></span>
                            </span>
                            {!! Form::text('descripcion',$solicitud->descripcion,['placeholder'=>'Descripcion del Gasto','class'=>'form-control']) !!}

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Organizacion','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon glyphicon glyphicon-th-large" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('organizacion', $combo['organizacion'],null,['placeholder'=>'Selecciona Organizacion','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    {!! Form::label('Tipo de Pago','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon glyphicon glyphicon-th-large" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('tipopago', $combo['tipopago'],null,['placeholder'=>'Selecciona Tipo de Pago','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Observaciones','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon glyphicon-list"></span>
                            </span>
                            {!! Form::text('observaciones',$solicitud->observaciones,['placeholder'=>'Obserzaciones','class'=>'form-control']) !!}

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Status','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon glyphicon glyphicon-th-large" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('status', $combo['status'],null,['placeholder'=>'Selecciona Status','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">
                            Guardar
                        </button>
                        <a  class="btn btn-danger" role="button" data-toggle="modal" data-target="#salir">Cancelar</a>

                    </div>
                </div>


                {!! Form::close() !!}



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
                    <a href="{!! route('solicitudes') !!}" class="btn btn-success" role="button">Salir</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



@endsection
@section('scripts')

@endsection