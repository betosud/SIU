<div class="row margin">
    <div class="input-field col  m6 s12">
        <i class="material-icons prefix ">chrome_reader_mode</i>
        {!! Form::text('himno_final',"",['class'=>'validate input-field','id'=>'himno_final','placeholder'=>'Ingrse Nombre y Numero'])  !!}
        @if ($errors->has('himno_final'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('himno_final') }}</strong>
                                </span>
        @endif
        <label for="himno_final" data-error="dato no valido" data-success="Correcto" class="left-align">Himno Final</label>
        <div class="form-group{{ $errors->has('himno_final') ? ' has-error' : '' }}">
        </div>
    </div>

    <div class="input-field col m6 s12">
        <i class="material-icons prefix">account_circle</i>
        {!! Form::text('oracion_final',"",['class'=>'validate input-field','id'=>'oracion_final','placeholder'=>'Ingresa el Nombre completo'])  !!}
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


<div class="row margin">
    <div class="input-field col offset-l9 m3 s6">
        <i class="material-icons prefix">supervisor_account</i>
        {!! Form::text('asistencia','',['class'=>'validate input-field asistencia','id'=>'asistencia','placeholder'=>'Total Asistencia'])  !!}
        @if ($errors->has('asistencia'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('asistencia') }}</strong>
                            </span>
        @endif
        <label for="asistencia" data-error="dato no valido" data-success="Correcto" class="left-align">Total Asistencia</label>
        <div class="form-group{{ $errors->has('asistencia') ? ' has-error' : '' }}">
        </div>
    </div>
</div>