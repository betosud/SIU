@extends('layouts.app')

@section('content')


    <div class="container-fluid">
        <div class="row">
            <div class="col s12 m12 z-depth-3 card-panel">
                <div class="row">
                    <div class="input-field col s12 center">
                        <h4 class="center login-form-text">Nuevo Usuario</h4>
                    </div>
                </div>

                {!! Form::open(array('url' => 'guardarusuario', 'method' => 'post','class'=>'form-horizontal')) !!}
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">business</i>
                        {!!  Form::select('idestaca', $combos['estacas'],null,['class'=>'validate input-field','id'=>'idestaca','placeholder'=>'Selecciona Estaca']) !!}
                        @if ($errors->has('idestaca'))
                            <span class="help-block red-text">
                                <strong>{{ $errors->first('idestaca') }}</strong>
                            </span>
                        @endif
                        <label for="idestaca" data-error="dato no valido" data-success="Correcto" class="left-align">Estaca</label>
                        <div class="form-group{{ $errors->has('idestaca') ? ' has-error' : '' }}">
                        </div>
                    </div>
                </div>

                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">location_city</i>
                        {!!  Form::select('idbarrio', $combos['barrios'],null,['class'=>'validate input-field','id'=>'idbarrio','placeholder'=>'Selecciona Barrio']) !!}
                        @if ($errors->has('idbarrio'))
                            <span class="help-block red-text">
                                <strong>{{ $errors->first('idbarrio') }}</strong>
                            </span>
                        @endif
                        <label for="idestaca" data-error="dato no valido" data-success="Correcto" class="left-align">Barrio</label>
                        <div class="form-group{{ $errors->has('idbarrio') ? ' has-error' : '' }}">
                        </div>
                    </div>
                </div>



                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <label for="name" data-error="dato no valido" data-success="Correcto" class="left-align">Nombre Del Usuario</label>
                        {!! Form::text('name','',['class'=>'validate input-field','id'=>'name','placeholder'=>'Ingresa el Nombre completo'])  !!}
                        @if ($errors->has('name'))
                            <span class="help-block red-text">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        </div>
                    </div>
                </div>


                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">mail</i>
                        <label for="email" data-error="dato no valido" data-success="Correcto" class="left-align">Correo Electronico</label>
                        {!! Form::email('email','',['class'=>'validate input-field','id'=>'email','placeholder'=>'nombre@dominio.com'])  !!}
                        @if ($errors->has('email'))
                            <span class="help-block red-text">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        </div>
                    </div>
                </div>

                <div class="row margin">

                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <label for="password" data-error="dato no valido" data-success="Correcto" class="left-align">Password</label>
                        {!! Form::password('password','',['class'=>'awesome','id'=>'password','placeholder'=>'Min 6 caracteres'])  !!}
                        @if ($errors->has('password'))
                            <span class="help-block red-text">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                        </div>
                    </div>
                </div>


                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">assessment</i>
                        {!!  Form::select('llamamiento', $combos['llamamiento'],null,['class'=>'validate input-field','id'=>'llamamiento','placeholder'=>'Selecciona Llamamiento']) !!}
                        @if ($errors->has('llamamiento'))
                            <span class="help-block red-text">
                                <strong>{{ $errors->first('llamamiento') }}</strong>
                            </span>
                        @endif
                        <label for="llamamiento" data-error="dato no valido" data-success="Correcto" class="left-align">Llamamiento SUD</label>
                        <div class="form-group{{ $errors->has('llamamiento') ? ' has-error' : '' }}">
                        </div>
                    </div>
                </div>

                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">assessment</i>
                        {!!  Form::select('perfil', $combos['perfil'],null,['class'=>'validate input-field','id'=>'perfil','placeholder'=>'Selecciona Perfil']) !!}
                        @if ($errors->has('perfil'))
                            <span class="help-block red-text">
                                <strong>{{ $errors->first('perfil') }}</strong>
                            </span>
                        @endif
                        <label for="perfil" data-error="dato no valido" data-success="Correcto" class="left-align">Perfil</label>
                        <div class="form-group{{ $errors->has('perfil') ? ' has-error' : '' }}">
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="input-field col s4 m6 right">
                        <button type="submit" class="btn waves-effect waves-light col s12 grey darken-1 tooltipped" data-position="top" data-tooltip="Guardar Usuario"> <i class="material-icons">save</i>Guardar</button>
                    </div>
                {{--</div>--}}
                {{--<div class="row">--}}
                    <div class="input-field col s4 m6 right">
                        <a href="#salir"  class="btn waves-effect waves-light col s12 red lighten-2 tooltipped modal-trigger" data-position="top" data-tooltip="Salir del Modulo"><i class="material-icons">cancel</i>Cancelar</a>
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
            <a href="{!! route('usuarios') !!}" class="modal-action modal-close waves-effect waves-green btn-flat green lighten-2">De Acuerdo</a>
            <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat alert-dismissable red lighten-2">Cancelar</a>
        </div>
    </div>


@endsection



@section('scripts')



@endsection