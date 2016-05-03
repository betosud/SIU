@extends('layouts.app')


@section('contenido')


    <div class="container-fluid">
        <div class="col-md-10 col-lg-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Nuevo Sit</h3>
                </div>

                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ $error }}</div>
                    @endforeach
                @endif

                {!! Form::open(array('url' => 'guardarsit', 'method' => 'post','class'=>'form-horizontal')) !!}
                <div class="form-group">
                    {!! Form::text('status',25 ,['class'=>'hide']) !!}
                    {!! Form::text('statuscomprobantes',67 ,['class'=>'hide']) !!}
                    {!! Form::text('enviooficinas','0' ,['class'=>'hide']) !!}
                    {!! Form::text('user_id',Auth::user()->id ,['class'=>'hide']) !!}

                </div>


                <div class="form-group">
                    {!! Form::label('Solicitud','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon glyphicon-file"></span>
                            </span>
                            {!! Form::text('idsolicitud',$solicitud->id,['placeholder'=>'Nombre Completo','class'=>'form-control','readonly'=>'']) !!}

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('fecha','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class=' input-group'>
                            <span class="input-group-addon glyphicon glyphicon-calendar"></span>
                            {!! Form::text('fecha',"",['placeholder'=>'Fecha','class'=>'date form-control','id'=>'date']) !!}
                        </div>
                    </div>
                    </div>

                <div class="form-group">
                    {!! Form::label('Referencia (id)','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon glyphicon-file"></span>
                            </span>
                            {!! Form::text('id',"",['placeholder'=>'Numero de Referencia','class'=>'form-control']) !!}

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('Categoria','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon glyphicon glyphicon-tasks" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('categoria', $categoria,null,['placeholder'=>'Selecciona Categoria','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Pte. Organizacion','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon glyphicon glyphicon-user" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('pteorganizacion', $lideres,null,['placeholder'=>'Selecciona Lider','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Obispado','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon glyphicon glyphicon-user" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('obispo', $lideres,null,['placeholder'=>'Selecciona Lider','class'=>'form-control']) !!}
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