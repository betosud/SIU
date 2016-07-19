<ul class="collection">

<div class="ref_discursantegrupo1" id="discursantegrupo1num1">
    <div class="input-field col m6 s12">
        <i class="material-icons prefix">account_circle</i>
        {!! Form::text('tbxdiscursantegrupo1num1',"",['class'=>'validate input-field tbxdiscursante','id'=>'tbxdiscursantegrupo1num1','placeholder'=>'Nombre completo del Discursante'])  !!}
        <label name="lbldiscursantegrupo1num1" id="lbldiscursantegrupo1num1" data-error="dato no valido" data-success="Correcto" class="left-align lbldiscursante">Nombre Discursante</label>
    </div>
    <div class="input-field col m6 s12" id="discursante1">
        <i class="material-icons prefix">chrome_reader_mode</i>
        {!! Form::text('tbxdiscursantetemagrupo1num1',"",['class'=>'validate input-field tbxdiscursantetema','id'=>'tbxdiscursantetemagrupo1num1','placeholder'=>'Tema'])  !!}
        <label name="lbldiscursantetemagrupo1num1" id="lbldiscursantetemagrupo1num1" data-error="dato no valido" data-success="Correcto" class="left-align lbldiscursantetema">Tema Discursante</label>
    </div>
</div>

</ul>
<a id="agregar_discursantegrupo1" class="agregar_discursantegrupo1 btn-floating btn-sm waves-effect waves-light blue"><i class="material-icons">add</i></a>
<a id="eliminar_discursantegrupo1" class="eliminar_discursantegrupo1 btn-floating btn-sm waves-effect waves-light red"><i class="material-icons">delete</i></a>



<div class="row margin">
    <div class="input-field col  m12 s12">
        <i class="material-icons prefix ">chrome_reader_mode</i>
        {!! Form::text('himno_intermedio',"",['class'=>'validate input-field','id'=>'himno_intermedio','placeholder'=>'Ingrse Nombre y Numero'])  !!}
        @if ($errors->has('himno_intermedio'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('himno_sacramental') }}</strong>
                                </span>
        @endif
        <label for="himno_intermedio" data-error="dato no valido" data-success="Correcto" class="left-align">Himno Intermedio</label>
        <div class="form-group{{ $errors->has('himno_intermedio') ? ' has-error' : '' }}">
        </div>
    </div>

</div>



<ul class="collection">

    <div class="ref_discursantegrupo2" id="discursantegrupo2num1">
        <div class="input-field col m6 s12">
            <i class="material-icons prefix">account_circle</i>
            {!! Form::text('tbxdiscursantegrupo2num1',"",['class'=>'validate input-field tbxdiscursante','id'=>'tbxdiscursantegrupo2num1','placeholder'=>'Nombre completo del Discursante'])  !!}
            <label name="lbldiscursantegrupo2num1" id="lbldiscursantegrupo2num1" data-error="dato no valido" data-success="Correcto" class="left-align lbldiscursante">Nombre Discursante</label>
        </div>
        <div class="input-field col m6 s12" id="discursante1">
            <i class="material-icons prefix">chrome_reader_mode</i>
            {!! Form::text('tbxdiscursantetemagrupo2num1',"",['class'=>'validate input-field tbxdiscursantetema','id'=>'tbxdiscursantetemagrupo2num1','placeholder'=>'Tema'])  !!}
            <label name="lbldiscursantetemagrupo2num1" id="lbldiscursantetemagrupo2num1" data-error="dato no valido" data-success="Correcto" class="left-align lbldiscursantetema">Tema Discursante</label>
        </div>
    </div>

</ul>
<a id="agregar_discursantegrupo2" class="agregar_discursantegrupo2 btn-floating btn-sm waves-effect waves-light blue"><i class="material-icons">add</i></a>
<a id="eliminar_discursantegrupo2" class="eliminar_discursantegrupo2 btn-floating btn-sm waves-effect waves-light red"><i class="material-icons">delete</i></a>
