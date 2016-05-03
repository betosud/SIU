@extends('layouts.app')


@section('contenido')


    <div class="container-fluid">
        <div class="col-md-10 col-lg-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">{!! $discurso->nombre !!}</h3>
                </div>

                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            {{ $error }}</div>
                    @endforeach
                @endif


                {!! Form::model($discurso,['route' => ['actualizardiscurso',$discurso->id], 'method' => 'PUT','class'=>'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::text('idbarrio',Auth::user()->idbarrio ,['class'=>'hide']) !!}
                    {!! Form::text('user_id',Auth::user()->id ,['class'=>'hide']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Fecha','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='date'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            {!! Form::text('fecha',$discurso->fechadma,['placeholder'=>'Seleccione Fecha','class'=>'form-control']) !!}

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Hora','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                            </span>

                            {!! Form::text('hora',$discurso->horahm,['placeholder'=>'Seleccione Hora','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('Nombre','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon glyphicon-user"></span>
                            </span>
                            {!! Form::text('nombre', $discurso->nombrecap,['placeholder'=>'Nombre Completo','class'=>'form-control']) !!}

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('Tema','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon glyphicon glyphicon-book" ></span>
                            {!! Form::text('tema',$discurso->temacap,['placeholder'=>'Tema Asignado','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Duracion','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon glyphicon glyphicon-time" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('duracion', ['5'=>'5 Minutos','10'=>'10 Minutos','15'=>'15 Minutos','20'=>'20 Minutos'],null,['placeholder'=>'Selecciona Duracion','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Lugar','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon glyphicon glyphicon-globe" ></span>
                            {!! Form::text('lugar',$discurso->lugarcap,['placeholder'=>'Lugar','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Realizado','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon glyphicon glyphicon-time" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('realizado', ['0'=>'No','1'=>'Si'],null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Lider 1','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon glyphicon glyphicon-user" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('lider1', $lideres,null,['placeholder'=>'Selecciona Lider','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Lider 2','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon glyphicon glyphicon-user" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('lider2', $lideres,null,['placeholder'=>'Selecciona Lider','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Lider 3','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='date input-group' id='time'>
                            <span class="input-group-addon glyphicon glyphicon-user" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('lider3', $lideres,null,['placeholder'=>'Selecciona Lider','class'=>'form-control']) !!}
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
                    <a href="{!! route('discursos') !!}" class="btn btn-success" role="button">Salir</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



@endsection

@section('scripts')


@endsection