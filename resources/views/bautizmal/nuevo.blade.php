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


                @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                <script>
                Materialize.toast('{!! $error !!}', 3000, 'rounded');
                </script>
                @endforeach
                @endif


                <div class="container-fluid">
                    {!! Form::open(array('url' => 'guardarbautizmal', 'method' => 'post','class'=>'form-horizontal')) !!}
                    <div class="form-group">
                        {!! Form::text('idbarrio',Auth::user()->idbarrio ,['class'=>'hide']) !!}
                        {!! Form::text('user_id',Auth::user()->id ,['class'=>'hide']) !!}
                    </div>


                    <div class="row margin">
                        <div class="input-field col  m6 s12">
                            <i class="material-icons prefix ">event</i>
                            <label for="fecha" data-error="dato no valido" data-success="Correcto" class="left-align">Fecha</label>
                            {!! Form::text('fecha','',['class'=>'validate input-field datepicker','id'=>'datepicker','placeholder'=>'Seleeciona Fecha'])  !!}
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
                            {!! Form::text('hora','',['class'=>'validate input-field pick-a-time','id'=>'pick-a-time','placeholder'=>'Seleeciona Hora'])  !!}
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
                            <label for="bautizmode" data-error="dato no valido" data-success="Correcto" class="left-align">Bautizmo de </label>
                            {!! Form::text('bautizmode','',['class'=>'validate input-field','id'=>'bautizmode','placeholder'=>'Ingresa el Nombre completo'])  !!}
                            @if ($errors->has('bautizmode'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('bautizmode') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('bautizmode') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        {{--</div>--}}

                        {{--<div class="row margin">--}}
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <label for="dirigidopor" data-error="dato no valido" data-success="Correcto" class="left-align">Direccion del Programa </label>
                            {!! Form::text('dirigidopor','',['class'=>'validate input-field','id'=>'dirigidopor','placeholder'=>'Ingresa el Nombre completo'])  !!}
                            @if ($errors->has('dirigidopor'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('dirigidopor') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('dirigidopor') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row margin">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <label for="direccion_himnos" data-error="dato no valido" data-success="Correcto" class="left-align">Direccion Himnos</label>
                            {!! Form::text('direccion_himnos','',['class'=>'validate input-field','id'=>'direccion_himnos','placeholder'=>'Ingresa el Nombre completo'])  !!}
                            @if ($errors->has('direccion_himnos'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('direccion_himnos') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('direccion_himnos') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        {{--</div>--}}

                        {{--<div class="row margin">--}}
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <label for="pianista" data-error="dato no valido" data-success="Correcto" class="left-align">Pianista</label>
                            {!! Form::text('pianista','',['class'=>'validate input-field','id'=>'pianista','placeholder'=>'Ingresa el Nombre completo'])  !!}
                            @if ($errors->has('pianista'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('pianista') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('pianista') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row margin">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">chrome_reader_mode</i>
                            <label for="himno_inicial" data-error="dato no valido" data-success="Correcto" class="left-align">Himno Inicial</label>
                            {!! Form::text('himno_inicial','',['class'=>'validate input-field himno_inicial','id'=>'himno_inicial','placeholder'=>'Numero y titulo de Himno'])  !!}
                            @if ($errors->has('himno_inicial'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('himno_inicial') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('himno_inicial') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        {{--</div>--}}

                        {{--<div class="row margin">--}}
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <label for="oracion_inicial" data-error="dato no valido" data-success="Correcto" class="left-align">Oracion Inicial</label>
                            {!! Form::text('oracion_inicial','',['class'=>'validate input-field','id'=>'oracion_inicial','placeholder'=>'Ingresa el Nombre completo'])  !!}
                            @if ($errors->has('oracion_inicial'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('oracion_inicial') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('oracion_inicial') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>

                    {{--oradores--}}
                    <div class="row margin">
                    <div class="row" id ='discursantes1'>
                        <h4 class="referencia_orador center">1 Orador</h4>
                        <div class="col m12 discursantes">

                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix">account_circle</i>
                                <label for="tbxnombre_orador1"  data-error="dato no valido" data-success="Correcto" class="left-align">Nombre</label>
                                {!! Form::text('tbxnombre_orador1','',['class'=>'validate input-field tbxnombre_orador1','id'=>'tbxnombre_orador1','placeholder'=>'Nombre Completo'])  !!}
                                @if ($errors->has('tbxnombre_orador1'))
                                    <span class="help-block red-text">
                                <strong>{{ $errors->first('tbxnombre_orador1') }}</strong>
                            </span>
                                @endif
                                <div class="form-group{{ $errors->has('tbxnombre_orador1') ? ' has-error' : '' }}">
                                </div>
                            </div>
                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix">chrome_reader_mode</i>
                                <label for="tbxtema_orador1" data-error="dato no valido" data-success="Correcto" class="left-align">Tema</label>
                                {!! Form::text('tbxtema_orador1','',['class'=>'validate input-field tbxtema_orador1','id'=>'tbxtema_orador1','placeholder'=>'Tema'])  !!}
                                @if ($errors->has('tbxtema_orador1'))
                                    <span class="help-block red-text">
                                <strong>{{ $errors->first('tbxtema_orador1') }}</strong>
                            </span>
                                @endif
                                <div class="form-group{{ $errors->has('tbxtema_orador1') ? ' has-error' : '' }}">
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="col m12">
                        <a href="#!" id="agregar_discursante" class="agregar_discursante btn-floating btn-small waves-effect waves-light blue lighten-2 "><i class="material-icons">add</i></a>
                        <a href="#!" id='eliminar_discursante' class="eliminar_discursante btn-floating btn-small waves-effect waves-light blue lighten-2"><i class="material-icons">remove</i></a>
                    </div>

</div>

                    {{--fin oradores--}}


                    <div class="row margin">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <label for="testigo1" data-error="dato no valido" data-success="Correcto" class="left-align">Nombre de Testigo</label>
                            {!! Form::text('testigo1','',['class'=>'validate input-field','id'=>'testigo1','placeholder'=>'Nombre Completo'])  !!}
                            @if ($errors->has('testigo1'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('testigo1') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('testigo1') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        {{--</div>--}}

                        {{--<div class="row margin">--}}
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <label for="testigo2" data-error="dato no valido" data-success="Correcto" class="left-align">Nombre de Testigo</label>
                            {!! Form::text('testigo2','',['class'=>'validate input-field','id'=>'testigo2','placeholder'=>'Nombre Completo'])  !!}
                            @if ($errors->has('testigo2'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('testigo2') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('testigo2') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>


                    <div class="row margin">
                        <div class="input-field col m12 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <label for="ordenanzapor" data-error="dato no valido" data-success="Correcto" class="left-align">Ordenanza Por</label>
                            {!! Form::text('ordenanzapor','',['class'=>'validate input-field','id'=>'ordenanzapor','placeholder'=>'Nombre Completo'])  !!}
                            @if ($errors->has('ordenanzapor'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('ordenanzapor') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('ordenanzapor') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        </div>

                    <div class="row margin">
                        <div class="input-field col m12 s12">
                            <i class="material-icons prefix">format_list_bulleted</i>
                            <label for="actividades" data-error="dato no valido" data-success="Correcto" class="left-align">Actividades de Espera</label>
                            {!! Form::textarea('actividades','',['class'=>'validate materialize-textarea','id'=>'actividades','placeholder'=>'Actividades'])  !!}
                            {{--<textarea id="actividades" name="actividades" class="materialize-textarea"></textarea>--}}
                            @if ($errors->has('actividades'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('actividades') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('actividades') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row margin">
                        <div class="input-field col m12 s12">
                            <i class="material-icons prefix">format_list_bulleted</i>
                            <label for="actividades" data-error="dato no valido" data-success="Correcto" class="left-align">Hnos que dan la Bienvenida al Barrio</label>
                            {!! Form::textarea('bienvenida','',['class'=>'validate materialize-textarea','id'=>'bienvenida','placeholder'=>'Hnos que dan la bienvenida al Barrio'])  !!}
                            {{--<textarea id="actividades" name="actividades" class="materialize-textarea"></textarea>--}}
                            @if ($errors->has('bienvenida'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('bienvenida') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('actividades') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row margin">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">chrome_reader_mode</i>
                            <label for="himno_final" data-error="dato no valido" data-success="Correcto" class="left-align">Himno Final</label>
                            {!! Form::text('himno_final','',['class'=>'validate input-field himno_final','id'=>'himno_final','placeholder'=>'Numero y titulo de Himno'])  !!}
                            @if ($errors->has('himno_final'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('himno_final') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('himno_final') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        {{--</div>--}}

                        {{--<div class="row margin">--}}
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix">account_circle</i>
                            <label for="oracion_final" data-error="dato no valido" data-success="Correcto" class="left-align">Oracion Final</label>
                            {!! Form::text('oracion_final','',['class'=>'validate input-field','id'=>'oracion_final','placeholder'=>'Ingresa el Nombre completo'])  !!}
                            @if ($errors->has('oracion_final'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('oracion_final') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('oracion_final') ? ' has-error' : '' }}">
                            </div>
                        </div>
                    </div>



                    <div class="row margin">
                        <div class="input-field col offset-l9 m3 s6">
                            <i class="material-icons prefix">supervisor_account</i>
                            <label for="asistencia" data-error="dato no valido" data-success="Correcto" class="left-align">Total Asistencia</label>
                            {!! Form::text('asistencia','',['class'=>'validate input-field asistencia','id'=>'asistencia','placeholder'=>'Total Asistencia'])  !!}
                            @if ($errors->has('asistencia'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('asistencia') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('asistencia') ? ' has-error' : '' }}">
                            </div>
                        </div>
                        {{--</div>--}}

                        {{--<div class="row margin">--}}
                        {{--<div class="input-field col m6 s12">--}}
                            {{--<i class="material-icons prefix">account_circle</i>--}}
                            {{--{!! Form::text('oracion_final','',['class'=>'validate input-field','id'=>'oracion_final','placeholder'=>'Ingresa el Nombre completo'])  !!}--}}
                            {{--@if ($errors->has('oracion_final'))--}}
                                {{--<span class="help-block red-text">--}}
                                {{--<strong>{{ $errors->first('oracion_final') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--<label for="oracion_final" data-error="dato no valido" data-success="Correcto" class="left-align">Oracion Final</label>--}}
                            {{--<div class="form-group{{ $errors->has('oracion_final') ? ' has-error' : '' }}">--}}
                            {{--</div>--}}
                        {{--</div>--}}
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
    {!! Html::script('js/oradoresbautizmales.js') !!}
@endsection