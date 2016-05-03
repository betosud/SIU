@extends('layouts.app')


@section('contenido')


    <div class="container-fluid">
        <div class="col-md-10 col-lg-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Nuevo Usuario</h3>
                </div>

                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ $error }}</div>
                    @endforeach
                @endif

                {!! Form::open(array('url' => 'guardarusuario', 'method' => 'post','class'=>'form-horizontal')) !!}
                <div class="form-group">

                </div>
                <div class="form-group">
                    {!! Form::label('Estaca','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon glyphicon glyphicon-home" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('idestaca', $combos['estacas'],null,['placeholder'=>'Selecciona Estaca','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Barrios','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon glyphicon glyphicon-home" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('idbarrio', $combos['barrios'],null,['placeholder'=>'Selecciona Barrio','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Nombre','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon glyphicon-user"></span>
                            </span>
                            {!! Form::text('name',"",['placeholder'=>'Nombre Completo','class'=>'form-control']) !!}

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
                            {!! Form::text('email',"",['placeholder'=>'nombre@dominio.com','class'=>'form-control']) !!}

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('password','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon glyphicon-asterisk"></span>
                            </span>
{{--                            {!! Form::password('password',"",['placeholder'=>'nombre@dominio.com','class'=>'form-control awesome']) !!}--}}
                            {!! Form::password('password', array('class' => 'form-control awesome','placeholder'=>'minimo 6 caracteres')) !!}

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Llamamiento','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon glyphicon glyphicon-heart-empty" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('llamamiento', $combos['llamamiento'],null,['placeholder'=>'Selecciona Llamamiento','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Perfil','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon glyphicon glyphicon-hdd" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('perfil', $combos['perfil'],null,['placeholder'=>'Selecciona Perfil','class'=>'form-control']) !!}
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
                    <a href="{!! route('usuarios') !!}" class="btn btn-success" role="button">Salir</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



@endsection

@section('scripts')


@endsection