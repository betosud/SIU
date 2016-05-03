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


                {!! Form::open(array('url' => 'registrosolicitud', 'method' => 'post','class'=>'form-horizontal')) !!}
                <div class="form-group">
                    {!! Form::text('status','63' ,['class'=>'hide']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Estaca','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon glyphicon glyphicon-home" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('idestaca', $combo['estacas'],null,['id'=>'idestaca', 'placeholder'=>'Selecciona Estaca','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('Barrios','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>
                            <span class="input-group-addon glyphicon glyphicon-home" ></span>
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {!!  Form::select('idbarrio',[],null,['placeholder'=>'Selecciona Barrio','id'=>'idbarrio','class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('Fecha','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class=' input-group'>
                            <span class="input-group-addon glyphicon glyphicon-calendar"></span>
                            {!! Form::text('fecha',"",['placeholder'=>'Fecha','class'=>'date form-control','id'=>'date']) !!}
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
                            {!! Form::text('solicitante',"",['placeholder'=>'Nombre Completo','class'=>'form-control']) !!}

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
                            {!! Form::text('mail',"",['placeholder'=>'nombre@dominio.com','class'=>'form-control']) !!}

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
                            {!! Form::text('pagable',"",['placeholder'=>'Nombre Completo','class'=>'form-control']) !!}

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
                            {!! Form::text('ife',"",['placeholder'=>'Numero de IFE 13 digitos','class'=>'form-control']) !!}

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
                            {!! Form::text('cantidad',"",['placeholder'=>'Monto del Gasto','class'=>'form-control']) !!}

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
                            {!! Form::text('descripcion',"",['placeholder'=>'Descripcion del Gasto','class'=>'form-control']) !!}

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

                {{--<div class="form-group">--}}
                    {{--{!! Form::label('Pte. Organizacion','',['class'=>'col-sm-2 control-label'])!!}--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<div class='input-group'>--}}
                            {{--<span class="input-group-addon glyphicon glyphicon-home" ></span>--}}
                            {{--{!! Form::text('duracion',"",['placeholder'=>'Duracion','class'=>'form-control']) !!}--}}
                            {{--{!!  Form::select('pteorganizacion', [],null,['placeholder'=>'Selecciona Lider','id'=>'pteorganizacion','class'=>'form-control']) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

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
                    {!! Form::label('Capcha','',['class'=>'col-sm-2 control-label'])!!}
                    <div class="col-sm-9">
                        <div class='input-group'>

                            {!! Form::text('captcha',"",['placeholder'=>'Ingresa Capcha','class'=>'form-control']) !!}

                            {!! Captcha::img() !!}
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
                    <a href="/" class="btn btn-success" role="button">Salir</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



@endsection
@section('scripts')

    <script>
        $('#idestaca').on('change',function (e) {


            var idestaca=e.target.value;

            var route= '/barriosbyestaca/'+idestaca;

            if(idestaca!=0) {
                $.get(route, function (res) {
//                console.log(res);

                    $("#idbarrio").empty();
                    $("#idbarrio").append('<option value=0 placeholder="Selecciona Barrio" >Selecciona Barrio</option>');

                    $.each(res, function (index, barrio) {
                        $("#idbarrio").append('<option value="' + index + '">' + barrio + '</option>');
                    })
                });
            }
            else {
                $("#idbarrio").empty();
                $("#idbarrio").append('<option value=0 placeholder="Selecciona Barrio" >Selecciona Barrio</option>');
            }

        })
    </script>

@endsection