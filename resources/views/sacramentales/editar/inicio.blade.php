<div class="row margin">
    <div class="input-field col  m6 s12">
        <i class="material-icons prefix ">event</i>
        {!! Form::text('fecha',$sacramental->fecha,['class'=>'validate input-field datepicker','id'=>'datepicker','placeholder'=>'Seleeciona Fecha'])  !!}
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
        {!! Form::text('hora',$sacramental->hora,['class'=>'validate input-field pick-a-time','id'=>'pick-a-time','placeholder'=>'Seleeciona Hora'])  !!}
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
    <div class="input-field col  m6 s12">
        <i class="material-icons prefix ">account_circle</i>
        {!! Form::text('preside',$sacramental->preside,['class'=>'validate input-field','id'=>'preside','placeholder'=>'Ingresa el Nombre completo'])  !!}
        @if ($errors->has('preside'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('preside') }}</strong>
                                </span>
        @endif
        <label for="preside" data-error="dato no valido" data-success="Correcto" class="left-align">Preside</label>
        <div class="form-group{{ $errors->has('preside') ? ' has-error' : '' }}">
        </div>
    </div>

    <div class="input-field col m6 s12">
        <i class="material-icons prefix">account_circle</i>
        {!! Form::text('direccion_programa',$sacramental->direccion_programa,['class'=>'validate input-field','id'=>'direccion_programa','placeholder'=>'Ingresa el Nombre completo'])  !!}
        @if ($errors->has('direccion_programa'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('direccion_programa') }}</strong>
                            </span>
        @endif
        <label for="direccion_programa" data-error="dato no valido" data-success="Correcto" class="left-align">Direccion Del Programa</label>
        <div class="form-group{{ $errors->has('direccion_programa') ? ' has-error' : '' }}">
        </div>
    </div>
</div>

<div class="row margin">
    <div class="input-field col  m6 s12">
        <i class="material-icons prefix ">account_circle</i>
        {!! Form::text('direccion_himnos',$sacramental->direccion_himnos,['class'=>'validate input-field','id'=>'direccion_himnos','placeholder'=>'Ingresa el Nombre completo'])  !!}
        @if ($errors->has('direccion_himnos'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('direccion_himnos') }}</strong>
                                </span>
        @endif
        <label for="direccion_himnos" data-error="dato no valido" data-success="Correcto" class="left-align">Director Himnos</label>
        <div class="form-group{{ $errors->has('direccion_himnos') ? ' has-error' : '' }}">
        </div>
    </div>

    <div class="input-field col m6 s12">
        <i class="material-icons prefix">account_circle</i>
        {!! Form::text('pianista',$sacramental->pianista,['class'=>'validate input-field','id'=>'pianista','placeholder'=>'Ingresa el Nombre completo'])  !!}
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
    <div class="input-field col  m6 s12">
        <i class="material-icons prefix ">chrome_reader_mode</i>
        {!! Form::text('himno_inicial',$sacramental->himno_inicial,['class'=>'validate input-field','id'=>'himno_inicial','placeholder'=>'Ingrse Nombre y Numero'])  !!}
        @if ($errors->has('himno_inicial'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('himno_inicial') }}</strong>
                                </span>
        @endif
        <label for="himno_inicial" data-error="dato no valido" data-success="Correcto" class="left-align">Himno Inicial</label>
        <div class="form-group{{ $errors->has('himno_inicial') ? ' has-error' : '' }}">
        </div>
    </div>

    <div class="input-field col m6 s12">
        <i class="material-icons prefix">account_circle</i>
        {!! Form::text('oracion_inicial',$sacramental->oracion_inicial,['class'=>'validate input-field','id'=>'oracion_inicial','placeholder'=>'Ingresa el Nombre completo'])  !!}
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






