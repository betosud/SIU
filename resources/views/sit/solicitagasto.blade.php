@extends('layouts.app')

@section('content')

        <div class="container">
            <div class="row">
                <div class="col s12 m12 z-depth-3 card-panel">


                @if(Session::has('message'))
                    <script>
                        Materialize.toast('{!! Session::get('message') !!}', 3000, 'rounded');
                    </script>
                @endif
                <div class="row">
                    <div class="input-field col s12 center">
                        <h4 class="center login-form-text">Solicitud de Gasto</h4>
                    </div>
                </div>


                {{--estaca y barrio--}}
                    {!! Form::open(array('url' => 'guardarsolicitud', 'method' => 'post','class'=>'form-horizontal')) !!}


                    {!! Form::text('status','63' ,['class'=>'hide']) !!}
{{--                    {!! Form::text('token',csrf_token() ,['class'=>'hide']) !!}--}}
                    {!! Form::text('statuscomprobantes','67' ,['class'=>'hide']) !!}
                    {!! Form::text('enviado','0' ,['class'=>'hide']) !!}
                    <div class="row margin">
                        <div class="input-field col  m6 s12">
                            <i class="material-icons prefix ">location_city</i>
                            {!!  Form::select('idestaca', $combo['estacas'],null,['id'=>'idestaca', 'placeholder'=>'Selecciona Estaca','class'=>'form-control']) !!}
                            @if ($errors->has('idestaca'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('idestaca') }}</strong>
                            </span>
                            @endif
                            <label for="idestacalabel" data-error="dato no valido" data-success="Correcto" class="left-align">Selecciona estaca</label>
                            <div class="form-group{{ $errors->has('idestaca') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        {{--</div>--}}


                        {{--<div class="row margin">--}}
                        <div class="input-field col  m6 s12">
                            <i class="material-icons prefix">location_city</i>
                            {!!  Form::select('idbarrio',[],null,['placeholder'=>'Selecciona Barrio','id'=>'idbarrio','class'=>'idbarrio']) !!}
                            @if ($errors->has('idbarrio'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('idbarrio') }}</strong>
                            </span>
                            @endif
                            <label for="idbarriolabel" data-error="dato no valido" data-success="Correcto" class="left-align">Selecciona Barrio</label>
                            <div class="form-group{{ $errors->has('idbarrio') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row margin">
                        {{--<div class="input-field col  m6 s12">--}}
                            {{--<i class="material-icons prefix ">event</i>--}}
                            {{--{!! Form::text('fecha','',['class'=>'validate input-field datepicker','id'=>'datepicker','placeholder'=>'Seleeciona Fecha'])  !!}--}}
                            {{--@if ($errors->has('fecha'))--}}
                                {{--<span class="help-block red-text">--}}
                                {{--<strong>{{ $errors->first('fecha') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--<label for="fecha" data-error="dato no valido" data-success="Correcto" class="left-align">Fecha</label>--}}
                            {{--<div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <label for="solicitante" data-error="dato no valido" data-success="Correcto" class="left-align">Solicitante</label>
                            {!! Form::text('solicitante','',['class'=>'validate','id'=>'solicitante','placeholder'=>'Ingresa el Nombre completo'])  !!}
                            @if ($errors->has('nombre'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('solicitante') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('solicitante') ? ' has-error' : '' }}"></div>
                        </div>

                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">mail</i>
                            <label for="mail" data-error="dato no valido" data-success="Correcto" class="left-align">Correo Electronico</label>
                            {!! Form::email('mail','',['class'=>'validate','id'=>'mail','placeholder'=>'nombre@dominio.com'])  !!}
                            @if ($errors->has('mail'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('mail') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('mail') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row margin">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <label for="pagable" data-error="dato no valido" data-success="Correcto" class="left-align">Pagable</label>
                            {!! Form::text('pagable','',['class'=>'validate input-field','id'=>'pagable','placeholder'=>'Nombre Completo'])  !!}
                            @if ($errors->has('pagable'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('pagable') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('pagable') ? ' has-error' : '' }}">
                            </div>
                        </div>

                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">credit_card</i>
                            <label for="ife" data-error="dato no valido" data-success="Correcto" class="left-align">Numero de IFE</label>
                            {!! Form::text('ife','',['class'=>'validate input-field','id'=>'ife','placeholder'=>'13 digitos'])  !!}
                            @if ($errors->has('ife'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('ife') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('ife') ? ' has-error' : '' }}">
                            </div>
                        </div>

                    </div>

                    <div class="row margin">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">attach_money</i>
                            <label for="cantidad" data-error="dato no valido" data-success="Correcto" class="left-align">Cantidad</label>
                            {!! Form::text('cantidad','',['class'=>'validate input-field','id'=>'cantidad','placeholder'=>'Cantidad'])  !!}
                            @if ($errors->has('cantidad'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('cantidad') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('cantidad') ? ' has-error' : '' }}">
                            </div>
                        </div>

                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">description</i>
                            <label for="descripcion" data-error="dato no valido" data-success="descripcion" class="left-align">Descripcion</label>
                            {!! Form::text('descripcion','',['class'=>'validate input-field','id'=>'descripcion','placeholder'=>'Descripcion'])  !!}
                            @if ($errors->has('descripcion'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('descripcion') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row margin">

                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">person</i>
                            {!!  Form::select('organizaciongasto', $combo['organizacion'],null,['placeholder'=>'Selecciona Organizacion','class'=>'validate input-field organizaciongasto','id'=>'organizaciongasto']) !!}
                            @if ($errors->has('organizaciongasto'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('organizaciongasto') }}</strong>
                            </span>
                            @endif
                            <label for="organizaciongasto" data-error="dato no valido" data-success="Correcto" class="left-align ">Organizacion</label>
                            <div class="form-group{{ $errors->has('organizaciongasto') ? ' has-error' : '' }}">
                            </div>
                        </div>


                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">person</i>
                            {!!  Form::select('tipopago', $combo['tipopago'],null,['placeholder'=>'Selecciona Tipo de pago','class'=>'validate input-field lider2','id'=>'tipopago']) !!}
                            @if ($errors->has('tipopago'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('tipopago') }}</strong>
                            </span>
                            @endif
                            <label for="tipopago" data-error="dato no valido" data-success="Correcto" class="left-align">Tipo de Pago</label>
                            <div class="form-group{{ $errors->has('tipopago') ? ' has-error' : '' }}">
                            </div>
                        </div>

                    </div>

                    <div class="row margin">
                        <div class="input-field col m6 s12">
                            <div class='input-group'>
                                {!! app('captcha')->display() !!}

                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block red-text">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row margin">
                        <div class="input-field col m6 s12">
                            <button type="submit" class="btn waves-effect waves-light col s6 grey darken-1 tooltipped" data-position="top" data-tooltip="Guardar Registro"> <i class="material-icons">save</i>Guardar</button>
                        </div>
                        {{--</div>--}}
                        {{--<div class="row">--}}
                        <div class="input-field col m6 s12">
                            <a href="#salir"  class="btn waves-effect waves-light col s6 red lighten-2 tooltipped modal-trigger" data-position="top" data-tooltip="Salir del Modulo"><i class="material-icons">cancel</i>Cancelar</a>
                        </div>
                    </div>


                    {!! Form::close() !!}

    </div>
                </div>
            </div>
        <!-- Modal Structure -->
        <div id="salir" class="modal">
            <div class="modal-content">

                <h5>Si Sale del Modulo no se Guardara los Cambios</h5>
            </div>
            <div class="modal-footer">
                <a href="/" class="modal-action modal-close waves-effect waves-green btn-flat green lighten-2">De Acuerdo</a>
                <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat alert-dismissable red lighten-2">Cancelar</a>
            </div>
        </div>


@endsection
@section('scripts')


    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        $('#idestaca').on('change',function (e) {
            var idestaca=e.target.value;
            var route= '/barriosbyestaca/'+idestaca;

            if(idestaca!=0) {
                $.get(route, function (res) {
//                console.log(res);

                    $("#idbarrio").empty();
                    $("#idbarrio").append('<option value="" placeholder="Selecciona Barrio" >Selecciona Barrio</option>');
                    $.each(res, function (index, barrio) {
                        $("#idbarrio").append('<option value="' + index + '">' + barrio + '</option>');
                    })

                    $('select').material_select();
                });
            }
            else {
                $("#idbarrio").empty();
                $("#idbarrio").append('<option value="" placeholder="Selecciona Barrio" >Selecciona Barrio</option>');
                $('select').material_select();
            }

        })
    </script>
@endsection