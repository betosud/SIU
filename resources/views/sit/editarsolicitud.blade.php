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

                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <script>
                                Materialize.toast($error, 3000, 'rounded');
                            </script>
                        @endforeach
                    @endif

                <div class="row">
                    <div class="input-field col s12 center">
                        <h4 class="center login-form-text">Editar Solicitud</h4>
                    </div>
                </div>


                {{--estaca y barrio--}}
                    {!! Form::model($sit,['route' => ['actualizarsolicitud',$sit->id], 'method' => 'PUT','class'=>'form-horizontal']) !!}

                    {!! Form::text('user_id',Auth::user()->id,['class'=>'hide']) !!}

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
                        {!!  Form::select('idbarrio',$combo['barrios'],null,['placeholder'=>'Selecciona Barrio','id'=>'idbarrio','class'=>'idbarrio']) !!}
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
                    <div class="input-field col  m6 s12">
                        <i class="material-icons prefix ">event</i>
                        <label for="fecha" data-error="dato no valido" data-success="Correcto" class="left-align">Fecha</label>
                        {!! Form::text('fecha',$sit->fecha,['class'=>'validate input-field datepicker','id'=>'datepicker','placeholder'=>'Seleeciona Fecha'])  !!}
                        @if ($errors->has('fecha'))
                            <span class="help-block red-text">
                                <strong>{{ $errors->first('fecha') }}</strong>
                            </span>
                        @endif
                        <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                        </div>
                    </div>

                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">account_circle</i>
                        <label for="solicitante" data-error="dato no valido" data-success="Correcto" class="left-align">Solicitante</label>
                        {!! Form::text('solicitante',$sit->solicitante,['class'=>'validate input-field','id'=>'solicitante','placeholder'=>'Ingresa el Nombre completo'])  !!}
                        @if ($errors->has('nombre'))
                            <span class="help-block red-text">
                                <strong>{{ $errors->first('solicitante') }}</strong>
                            </span>
                        @endif
                        <div class="form-group{{ $errors->has('solicitante') ? ' has-error' : '' }}">
                        </div>
                    </div>
                </div>


                <div class="row margin">
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">mail</i>
                        <label for="mail" data-error="dato no valido" data-success="Correcto" class="left-align">Correo Electronico</label>
                        {!! Form::email('mail',$sit->mail,['class'=>'validate input-field','id'=>'mail','placeholder'=>'nombre@dominio.com'])  !!}
                        @if ($errors->has('mail'))
                            <span class="help-block red-text">
                                <strong>{{ $errors->first('mail') }}</strong>
                            </span>
                        @endif
                        <div class="form-group{{ $errors->has('mail') ? ' has-error' : '' }}">
                        </div>
                    </div>
                    {{--</div>--}}

                    {{--<div class="row margin">--}}
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">account_circle</i>
                        <label for="pagable" data-error="dato no valido" data-success="Correcto" class="left-align">Pagable</label>
                        {!! Form::text('pagable',$sit->pagable,['class'=>'validate input-field','id'=>'pagable','placeholder'=>'Nombre Completo'])  !!}
                        @if ($errors->has('pagable'))
                            <span class="help-block red-text">
                                <strong>{{ $errors->first('pagable') }}</strong>
                            </span>
                        @endif
                        <div class="form-group{{ $errors->has('pagable') ? ' has-error' : '' }}">
                        </div>
                    </div>
                </div>

                <div class="row margin">
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">credit_card</i>
                        <label for="ife" data-error="dato no valido" data-success="Correcto" class="left-align">Numero de IFE</label>
                        {!! Form::text('ife',$sit->ife,['class'=>'validate input-field','id'=>'ife','placeholder'=>'13 digitos'])  !!}
                        @if ($errors->has('ife'))
                            <span class="help-block red-text">
                                <strong>{{ $errors->first('ife') }}</strong>
                            </span>
                        @endif
                        <div class="form-group{{ $errors->has('ife') ? ' has-error' : '' }}">
                        </div>
                    </div>
                    {{--</div>--}}

                    {{--<div class="row margin">--}}
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">attach_money</i>
                        <label for="cantidad" data-error="dato no valido" data-success="Correcto" class="left-align">Cantidad</label>
                        {!! Form::text('cantidad',$sit->cantidad,['class'=>'validate input-field','id'=>'cantidad','placeholder'=>'Cantidad'])  !!}
                        @if ($errors->has('cantidad'))
                            <span class="help-block red-text">
                                <strong>{{ $errors->first('cantidad') }}</strong>
                            </span>
                        @endif
                        <div class="form-group{{ $errors->has('cantidad') ? ' has-error' : '' }}">
                        </div>
                    </div>
                </div>

                <div class="row margin">
                    <div class="input-field col m12 s12">
                        <i class="material-icons prefix">description</i>
                        <label for="descripcion" data-error="dato no valido" data-success="Correcto" class="left-align">Descripcion del Gasto</label>
                        {!! Form::text('descripcion',$sit->descripcion,['class'=>'validate input-field','id'=>'descripcion','placeholder'=>'Descripcion de la Actividad'])  !!}
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
                        <i class="material-icons prefix">group</i>
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
                    {{--</div>--}}

                    {{--<div class="row margin">--}}
                </div>

                <div class="row margin">

                    {{--<div class="row">--}}
                        <div class="input-field col m4 s12 left">
                            <button type="submit" class="btn waves-effect waves-light col s6 grey darken-1 tooltipped" data-position="top" data-tooltip="Guardar Registro"> <i class="material-icons">save</i>Guardar</button>
                        </div>
                        <div class="input-field col m4 s12 left">
                            <a href="#salir"  class="btn waves-effect waves-light col s6 blue lighten-2 tooltipped modal-trigger" data-position="top" data-tooltip="Salir del Modulo"><i class="material-icons">cancel</i>Salir</a>
                        </div>


                    <div class="input-field col m4 s12 left">
                        <a href="#cancelarsolicitud"  class="btn waves-effect waves-light col s6 red lighten-2 tooltipped modal-trigger" data-position="top" data-tooltip="Cancelar Solicitud"><i class="material-icons">delete</i>Eliminar</a>
                    </div>
                    {{--</div>--}}

                </div>
                    {!! Form::close() !!}
            </div>
        </div>


        <!-- Modal Structure -->
        <div id="salir" class="modal">
            <div class="modal-content">

                <h5>Si Sale del Modulo no se Guardara los Cambios</h5>
            </div>
            <div class="modal-footer">
                <a href="{!! route('solicitudes') !!}" class="modal-action modal-close waves-effect waves-green btn-flat green lighten-2">De Acuerdo</a>
                <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat alert-dismissable blue lighten-2">Cancelar</a>
            </div>
        </div>



        <!-- Modal Structure -->
        <div id="cancelarsolicitud" class="modal">
            <div class="modal-content">
                <h5>Cancelar Solicitud</h5>

                {!! Form::open(['route'=>['eliminarsolicitud',$sit->id],'method'=>'DELETE']) !!}
                {!! Form::text('user_id',Auth::user()->id,['class'=>'hide']) !!}
                <div class="row margin">
                    <div class="input-field col m12 s12">
                        <i class="material-icons prefix">description</i>
                        {!! Form::text('observaciones',"",['class'=>'validate required input-field','id'=>'observaciones','placeholder'=>'Motivo de cancelacion'])  !!}
                        @if ($errors->has('observaciones'))
                            <script>
                                $('#cancelarsolicitud').openModal();
                            </script>
                            <span class="help-block red-text">
                                <strong>{{ $errors->first('observaciones') }}</strong>
                            </span>
                        @endif
                        <label for="observaciones" data-error="dato no valido" data-success="Correcto" class="left-align">Observaciones</label>
                        <div class="form-group{{ $errors->has('observaciones') ? ' has-error' : '' }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">


                    <div class="input-field col s4 m6 right">
                        <button type="submit" class="btn waves-effect waves-light col s6 red lighten-2 tooltipped " data-position="top" data-tooltip="Eliminar Solicitud"> <i class="material-icons">delete</i>Eliminar</button>

                    <a class="modal-action modal-close waves-effect waves-green btn-flat blue lighten-2">Cancelar</a>
                    </div>
                </div>

            </div>
            {!! Form::Close() !!}
        </div>

        @endsection
        @section('scripts')



@endsection