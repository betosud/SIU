@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m12 z-depth-3 card-panel">
                <div class="row">
                    <div class="input-field col s12 center">
                        <h6 class="center login-form-text">Editar Asignacion</h6>
                        <h6 class="center login-form-text">{!! $asignacion->nombre !!}</h6>

                    </div>
                </div>

                <div class="container-fluid">
                    {!! Form::model($asignacion,['route' => ['actualizarasignacion',$asignacion->id], 'method' => 'PUT','class'=>'form-horizontal']) !!}

                    <div class="form-group">

                    </div>

                    <div class="row margin">
                        <div class="input-field col  m6 s12">
                            <i class="material-icons prefix ">event</i>
                            <label for="fecha" data-error="dato no valido" data-success="Correcto" class="left-align">Fecha</label>
                            {!! Form::text('fecha',$asignacion->fecha,['class'=>'validate input-field datepicker','id'=>'datepicker','placeholder'=>'Seleeciona Fecha'])  !!}
                            @if ($errors->has('fecha'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('fecha') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        {{--</div>--}}


                        {{--<div class="row margin">--}}
                        <div class="input-field col  m6 s12">
                            <i class="material-icons prefix">alarm</i>
                            <label for="hora" data-error="dato no valido" data-success="Correcto" class="left-align">Hora</label>
                            {!! Form::text('hora',$asignacion->horahm,['class'=>'validate input-field pick-a-time','id'=>'pick-a-time','placeholder'=>'Seleeciona Hora'])  !!}
                            @if ($errors->has('hora'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('hora') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('hora') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row margin">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <label for="nombre" data-error="dato no valido" data-success="Correcto" class="left-align">Nombre del Miembro o Familia</label>
                            {!! Form::text('nombre',$asignacion->nombre,['class'=>'validate input-field','id'=>'nombre','placeholder'=>'Ingresa el Nombre completo'])  !!}
                            @if ($errors->has('nombre'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        {{--</div>--}}

                        {{--<div class="row margin">--}}
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">description</i>
                            <label for="asignacion" data-error="dato no valido" data-success="Correcto" class="left-align">Asignacion</label>
                            {!! Form::text('asignacion',$asignacion->descripcion,['class'=>'validate input-field','id'=>'asignacion','placeholder'=>'Descripcion de la Asignacion'])  !!}
                            @if ($errors->has('asignacion'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('asignacion') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('asignacion') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row margin">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">place</i>
                            <label for="lugar" data-error="dato no valido" data-success="Correcto" class="left-align">Lugar</label>
                            {!! Form::text('lugar',$asignacion->lugar,['class'=>'validate input-field','id'=>'lugar','placeholder'=>'Lugar de la Asignacion'])  !!}
                            @if ($errors->has('lugar'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('lugar') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('lugar') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        {{--</div>--}}

                        {{--<div class="row margin">--}}
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">person</i>
                            {!!  Form::select('lider1', $lideres,null,['placeholder'=>'Selecciona Lider','class'=>'validate input-field lider1','id'=>'lider1']) !!}
                            @if ($errors->has('lider1'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('lider1') }}</strong>
                            </span>
                            @endif
                            <label for="lider1" data-error="dato no valido" data-success="Correcto" class="left-align ">Firma Lider 1</label>
                            <div class="form-group{{ $errors->has('lider1') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row margin">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">person</i>
                            {!!  Form::select('lider2', $lideres,null,['placeholder'=>'Selecciona Lider','class'=>'validate input-field lider2','id'=>'lider2']) !!}
                            @if ($errors->has('lider2'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('lider2') }}</strong>
                            </span>
                            @endif
                            <label for="lider2" data-error="dato no valido" data-success="Correcto" class="left-align">Firma Lider 2</label>
                            <div class="form-group{{ $errors->has('lider2') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        {{--</div>--}}

                        {{--<div class="row margin">--}}
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">person</i>
                            {!!  Form::select('lider3', $lideres,null,['placeholder'=>'Selecciona Lider','class'=>'validate input-field lider3','id'=>'lider3']) !!}
                            @if ($errors->has('lider3'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('lider3') }}</strong>
                            </span>
                            @endif
                            <label for="lider3" data-error="dato no valido" data-success="Correcto" class="left-align">Firma Lider 3</label>
                            <div class="form-group{{ $errors->has('lider3') ? ' has-error' : '' }}">
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
    </div>


    <div id="addlider" class="modal">
        <div class="modal-content">

            @include('lideres.agregar')


            <div class="row">
                <div class="input-field col s4 m6 left">
                    {{--<button type="submit" class="btn waves-effect waves-light col s12 grey darken-1 tooltipped" data-position="top" data-tooltip="Guardar"> <i class="material-icons">save</i>Guardar</button>--}}
                    {{--                    {!! link_to('#',$title='Guardar',$attributes=['id'=>'addlider','class'=>'btn waves-effect waves-light col s12 grey darken-1']) !!}--}}

                    <a href="#" id="addlidersave" class="btn waves-effect waves-light col s12 grey darken-1" data-position="top" data-tooltip="Guardar registro"><i class="material-icons">save</i>Guardar</a>
                </div>
                {{--</div>--}}
                {{--<div class="row">--}}
                <div class="input-field col s4 m6 lefç">
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn tooltipped red lighten-2 col s12" data-position="top" data-tooltip="Salir del Modulo"><i class="material-icons">cancel</i>Cancelar</a>
                    {{--<a href="#" class="btn modal-action modal-close waves-effect waves-light col s12 red lighten-2 tooltipped modal-trigger" data-position="top" data-tooltip="Salir del Modulo"><i class="material-icons">cancel</i>Cancelar</a>--}}
                    {{--<a  class="modal-action modal-close waves-effect waves-green btn-flat tooltipped modal-trigger" data-position="top" data-tooltip="Salir del Modulo"><i class="material-icons">cancel</i>Cancelar</a>--}}
                </div>
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
            <a href="{!! route('asignaciones') !!}" class="modal-action modal-close waves-effect waves-green btn-flat green lighten-2">De Acuerdo</a>
            <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat alert-dismissable red lighten-2">Cancelar</a>
        </div>
    </div>

@endsection
@section('scripts')
    {!! Html::script('js/asignacioneditar.js') !!}
    {!! Html::script('js/nuevolider.js') !!}
@endsection