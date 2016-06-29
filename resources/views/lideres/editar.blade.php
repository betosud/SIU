@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m12 z-depth-3 card-panel">
                <div class="row">
                    <div class="input-field col s12 center">
                        <h5 class="center login-form-text">Editar Lider</h5>
                        <h5 class="center login-form-text blue-text">{!! $lider->nombre !!}</h5>
                    </div>
                </div>

                <div class="container">
                    {!! Form::model($lider,['route' => ['actualizarlider',$lider->id], 'method' => 'PUT','class'=>'form-horizontal']) !!}



                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            {!! Form::text('nombre',$lider->nombre,['class'=>'validate input-field','id'=>'name','placeholder'=>'Ingresa el Nombre completo'])  !!}
                            @if ($errors->has('nombre'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                            @endif
                            <label for="nombre" data-error="dato no valido" data-success="Correcto" class="left-align">Nombre Del Lider</label>
                            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">mail</i>
                            {!! Form::email('email',$lider->email,['class'=>'validate input-field','id'=>'email','placeholder'=>'nombre@dominio.com'])  !!}
                            @if ($errors->has('email'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                            <label for="email" data-error="dato no valido" data-success="Correcto" class="left-align">Correo Electronico</label>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">call</i>
                            {!! Form::text('phone',$lider->phone,['class'=>'validate input-field','id'=>'name','placeholder'=>'Numero de contacto'])  !!}
                            @if ($errors->has('phone'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                            <label for="phone" data-error="dato no valido" data-success="Correcto" class="left-align">Numero de Contacto</label>
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">assessment</i>
                            {!!  Form::select('llamamiento', $combos['llamamientos'],null,['class'=>'validate input-field','id'=>'llamamiento','placeholder'=>'Selecciona Llamamiento']) !!}
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
                            {!!  Form::select('organizacion', $combos['organizacion'],null,['class'=>'validate input-field','id'=>'organizacion','placeholder'=>'Selecciona Organizacion']) !!}
                            @if ($errors->has('organizacion'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('organizacion') }}</strong>
                            </span>
                            @endif
                            <label for="organizacion" data-error="dato no valido" data-success="Correcto" class="left-align">Organizacion</label>
                            <div class="form-group{{ $errors->has('organizacion') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4 m6 right">
                            <button type="submit" class="btn waves-effect waves-light col s12 grey darken-1 tooltipped" data-position="top" data-tooltip="Guardar"> <i class="material-icons">save</i>Guardar</button>
                        </div>
                        {{--</div>--}}
                        {{--<div class="row">--}}
                        <div class="input-field col s4 m6 right">
                            <a href="#salir"  class="btn waves-effect waves-light col s12 red lighten-2 tooltipped modal-trigger" data-position="top" data-tooltip="Salir del Modulo"><i class="material-icons">cancel</i>Cancelar</a>
                        </div>
                    </div>

                    {!! Form::close() !!}


                    {!! Form::open(['route'=>['eliminarlider',$lider->id],'method'=>'DELETE']) !!}
                    <div class="row">
                        <div class="input-field col s4 m6 right">
                            <button type="submit" class="btn waves-effect waves-light col s12 red tooltipped " onclick="return confirm('Seguro que deseas Eliminar al Lider')" data-position="top" data-tooltip="Eliminar Lider"> <i class="material-icons">delete</i>Eliminar</button>
                        </div>
                    </div>
                    {{--<button class="btn waves-effect waves-light red lighten-2" onclick="return confirm('Seguro que deseas Eliminar al Usuario')" type="submit" name="action">Borrar--}}
                    {{--<i class="material-icons right">delete</i>--}}
                    {!! Form::Close() !!}

                </div>

            </div>
        </div>
    </div>




    <!-- Modal Structure -->
    <div id="salir" class="modal">
        <div class="modal-content">

            <h5>Si Sale del Modulo no se Guardara los Cambios</h5>
        </div>
        <div class="modal-footer">
            <a href="{!! route('lideres') !!}" class="modal-action modal-close waves-effect waves-green btn-flat green lighten-2">De Acuerdo</a>
            <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat alert-dismissable red lighten-2">Cancelar</a>
        </div>
    </div>

@endsection
@section('scripts')

@endsection