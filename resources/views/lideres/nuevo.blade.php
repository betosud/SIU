@extends('layouts.app')


@section('contenido')


    <div class="container-fluid">
        <div class="col-md-10 col-lg-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Nuevo Lider</h3>
                </div>

                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ $error }}</div>
                    @endforeach
                @endif

                {!! Form::open(array('url' => 'guardarlider', 'method' => 'post','class'=>'form-horizontal')) !!}
                <div class="form-group">
                {!! Form::text('idbarrio',Auth::user()->idbarrio ,['class'=>'hide']) !!}
                </div>


                <div class="form-group">
                        {!! Form::label('Nombre Completo','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        {!! Form::text('nombre',"",['placeholder'=>'Nombre Completo','class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                        {!! Form::label('E-mail','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        {!! Form::text('email',"",['placeholder'=>'correo@dominio.com','class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                        {!! Form::label('Num. Telefono','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        {!! Form::text('phone',"",['placeholder'=>'telefono 10 digitos','class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Llamamiento','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        {!!  Form::select('llamamiento', $combo['llamamientos'],null,['placeholder'=>'Selecciona Llamamiento','class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('Organizacion','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        {!!  Form::select('organizacion', $combo['organizacion'],null,['placeholder'=>'Selecciona Organizacion','class'=>'form-control']) !!}
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">
                            Guardar
                        </button>
                        <a  class="btn btn-danger" role="button" data-toggle="modal" data-target="#myModal">Cancelar</a>

                    </div>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Si sale del modulo los cambios no se guardaran</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <a href="lideres" class="btn btn-success" role="button">Salir</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



@endsection

@section('scripts')


@endsection