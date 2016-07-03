@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m12 z-depth-3 card-panel">
                <div class="row">
                    <div class="input-field col s12 center">
                        <h5 class="center login-form-text">Nuevo Bautizmal</h5>

                    </div>
                </div>


                <div class="container-fluid">
                    {!! Form::open(array('url' => 'guardarentrevista', 'method' => 'post','class'=>'form-horizontal')) !!}
                    <div class="form-group">
                        {!! Form::text('idbarrio',Auth::user()->idbarrio ,['class'=>'hide']) !!}
                        {!! Form::text('user_id',Auth::user()->id ,['class'=>'hide']) !!}
                    </div>


                    <div class="row margin">
                        <div class="input-field col  m6 s12">
                            <i class="material-icons prefix ">event</i>
                            {!! Form::text('fecha','',['class'=>'validate input-field datepicker','id'=>'datepicker','placeholder'=>'Seleeciona Fecha'])  !!}
                            @if ($errors->has('fecha'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('fecha') }}</strong>
                            </span>
                            @endif
                            <label for="fecha" data-error="dato no valido" data-success="Correcto" class="left-align">Fecha</label>
                            <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        {{--</div>--}}


                        {{--<div class="row margin">--}}
                        <div class="input-field col  m6 s12">
                            <i class="material-icons prefix">alarm</i>
                            {!! Form::text('hora','',['class'=>'validate input-field pick-a-time','id'=>'pick-a-time','placeholder'=>'Seleeciona Hora'])  !!}
                            @if ($errors->has('hora'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('hora') }}</strong>
                            </span>
                            @endif
                            <label for="hora" data-error="dato no valido" data-success="Correcto" class="left-align">Hora</label>
                            <div class="form-group{{ $errors->has('hora') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row margin">
                        <div class="input-field col m12 s12">
                            <i class="material-icons prefix">account_circle</i>
                            {!! Form::text('bautizmode','',['class'=>'validate input-field','id'=>'bautizmode','placeholder'=>'Ingresa el Nombre completo'])  !!}
                            @if ($errors->has('bautizmode'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('bautizmode') }}</strong>
                            </span>
                            @endif
                            <label for="bautizmode" data-error="dato no valido" data-success="Correcto" class="left-align">Bautizmo de </label>
                            <div class="form-group{{ $errors->has('bautizmode') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        {{--</div>--}}

                        {{--<div class="row margin">--}}
                        {{--<div class="input-field col m6 s12">--}}
                            {{--<i class="material-icons prefix">insert_emoticon</i>--}}
                            {{--{!!  Form::select('entrevistador', $lideres,null,['placeholder'=>'Selecciona Lider','class'=>'validate input-field entrevistador','id'=>'entrevistador']) !!}--}}
                            {{--@if ($errors->has('entrevistador'))--}}
                                {{--<span class="help-block red-text">--}}
                                {{--<strong>{{ $errors->first('entrevistador') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--<label for="entrevistador" data-error="dato no valido" data-success="Correcto" class="left-align">Entrevistador</label>--}}
                            {{--<div class="form-group{{ $errors->has('entrevistador') ? ' has-error' : '' }}">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>


                    <div class="row margin">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            {!! Form::text('direccion','',['class'=>'validate input-field','id'=>'direccion','placeholder'=>'Ingresa el Nombre completo'])  !!}
                            @if ($errors->has('direccion'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('direccion') }}</strong>
                            </span>
                            @endif
                            <label for="direccion" data-error="dato no valido" data-success="Correcto" class="left-align">Direccion Himnos</label>
                            <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        {{--</div>--}}

                        {{--<div class="row margin">--}}
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            {!! Form::text('pianista','',['class'=>'validate input-field','id'=>'pianista','placeholder'=>'Ingresa el Nombre completo'])  !!}
                            @if ($errors->has('pianista'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('pianista') }}</strong>
                            </span>
                            @endif
                            <label for="pianista" data-error="dato no valido" data-success="Correcto" class="left-align">Pianista</label>
                            <div class="form-group{{ $errors->has('pianista') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row margin">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">chrome_reader_mode</i>
                            {!! Form::text('himno_inicial','',['class'=>'validate input-field himno_inicial','id'=>'himno_inicial','placeholder'=>'Numero y titulo de Himno'])  !!}
                            @if ($errors->has('himno_inicial'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('himno_inicial') }}</strong>
                            </span>
                            @endif
                            <label for="himno_inicial" data-error="dato no valido" data-success="Correcto" class="left-align">Himno Inicial</label>
                            <div class="form-group{{ $errors->has('himno_inicial') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        {{--</div>--}}

                        {{--<div class="row margin">--}}
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            {!! Form::text('oracion_inicial','',['class'=>'validate input-field','id'=>'oracion_inicial','placeholder'=>'Ingresa el Nombre completo'])  !!}
                            @if ($errors->has('oracion_inicial'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('oracion_inicial') }}</strong>
                            </span>
                            @endif
                            <label for="oracion_inicial" data-error="dato no valido" data-success="Correcto" class="left-align">Oracion Inicial</label>
                            <div class="form-group{{ $errors->has('oracion_inicial') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row margin">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            {!! Form::text('testigo1','',['class'=>'validate input-field','id'=>'testigo1','placeholder'=>'Nombre Completo'])  !!}
                            @if ($errors->has('testigo1'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('testigo1') }}</strong>
                            </span>
                            @endif
                            <label for="testigo1" data-error="dato no valido" data-success="Correcto" class="left-align">Nombre de Testigo</label>
                            <div class="form-group{{ $errors->has('testigo1') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        {{--</div>--}}

                        {{--<div class="row margin">--}}
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            {!! Form::text('testigo2','',['class'=>'validate input-field','id'=>'testigo2','placeholder'=>'Nombre Completo'])  !!}
                            @if ($errors->has('testigo2'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('testigo2') }}</strong>
                            </span>
                            @endif
                            <label for="testigo2" data-error="dato no valido" data-success="Correcto" class="left-align">Nombre de Testigo</label>
                            <div class="form-group{{ $errors->has('testigo2') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row margin">
                        <div class="input-field col m12 s12">
                            <i class="material-icons prefix">account_circle</i>
                            {!! Form::text('ordenanzapor','',['class'=>'validate input-field','id'=>'ordenanzapor','placeholder'=>'Nombre Completo'])  !!}
                            @if ($errors->has('ordenanzapor'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('ordenanzapor') }}</strong>
                            </span>
                            @endif
                            <label for="ordenanzapor" data-error="dato no valido" data-success="Correcto" class="left-align">Ordenanza Por</label>
                            <div class="form-group{{ $errors->has('ordenanzapor') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        </div>

                        <div class="row margin">
                        <div class="input-field col m12 s12">
                            <i class="material-icons prefix">format_list_bulleted</i>
                            {!! Form::textarea('actividades','',['class'=>'validate materialize-textarea','id'=>'actividades','placeholder'=>'Actividades'])  !!}
                            {{--<textarea id="actividades" name="actividades" class="materialize-textarea"></textarea>--}}
                            @if ($errors->has('actividades'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('actividades') }}</strong>
                            </span>
                            @endif
                            <label for="actividades" data-error="dato no valido" data-success="Correcto" class="left-align">Actividades de Espera</label>
                            <div class="form-group{{ $errors->has('actividades') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row margin">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">chrome_reader_mode</i>
                            {!! Form::text('himno_final','',['class'=>'validate input-field himno_final','id'=>'himno_final','placeholder'=>'Numero y titulo de Himno'])  !!}
                            @if ($errors->has('himno_final'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('himno_final') }}</strong>
                            </span>
                            @endif
                            <label for="himno_final" data-error="dato no valido" data-success="Correcto" class="left-align">Himno Final</label>
                            <div class="form-group{{ $errors->has('himno_final') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        {{--</div>--}}

                        {{--<div class="row margin">--}}
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            {!! Form::text('oracion_final','',['class'=>'validate input-field','id'=>'oracion_final','placeholder'=>'Ingresa el Nombre completo'])  !!}
                            @if ($errors->has('oracion_final'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('oracion_final') }}</strong>
                            </span>
                            @endif
                            <label for="oracion_final" data-error="dato no valido" data-success="Correcto" class="left-align">Oracion Final</label>
                            <div class="form-group{{ $errors->has('oracion_final') ? ' has-error' : '' }}">
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



    <!-- Modal Structure -->
    <div id="salir" class="modal">
        <div class="modal-content">

            <h5>Si Sale del Modulo no se Guardara los Cambios</h5>
        </div>
        <div class="modal-footer">
            <a href="{!! route('bautizmales') !!}" class="modal-action modal-close waves-effect waves-green btn-flat green lighten-2">De Acuerdo</a>
            <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat alert-dismissable red lighten-2">Cancelar</a>
        </div>
    </div>
    {!! Form::open(['route' => ['himnos', ':VAL'], 'method' => 'GET', 'id' => 'form-getHimnos']) !!}
    {!! Form::close() !!}
@endsection
@section('scripts')

    {!! Html::script('js/himnosbautizmal.js') !!}

@endsection