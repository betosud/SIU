<ul class="collection">
    <?php
    $total=1;
    ?>
@foreach($sacramental->oradores as $orador)
    @if($orador->grupo==1)
<div class="ref_discursantegrupo{!! $total !!}" id="discursantegrupo1num{!! $total !!}">
    <div class="input-field col m6 s12">
        <i class="material-icons prefix">account_circle</i>
        {!! Form::text('tbxdiscursantegrupo1num'.$total,$orador->nombre,['class'=>'validate input-field tbxdiscursante','id'=>'tbxdiscursantegrupo1num'.$total,'placeholder'=>'Nombre completo del Discursante'])  !!}
        <label name="lbldiscursantegrupo1num{!! $total !!}" id="lbldiscursantegrupo1num{!! $total !!}" data-error="dato no valido" data-success="Correcto" class="left-align lbldiscursante">Nombre Discursante</label>
    </div>
    <div class="input-field col m6 s12" id="discursante{!! $total !!}">
        <i class="material-icons prefix">chrome_reader_mode</i>
        {!! Form::text('tbxdiscursantetemagrupo1num'.$total,$orador->tema,['class'=>'validate input-field tbxdiscursantetema','id'=>'tbxdiscursantetemagrupo1num'.$total,'placeholder'=>'Tema'])  !!}
        <label name="lbldiscursantetemagrupo1num{!! $total !!}" id="lbldiscursantetemagrupo1num{!! $total !!}" data-error="dato no valido" data-success="Correcto" class="left-align lbldiscursantetema">Tema Discursante</label>
    </div>

</div>
            <?php
            $total++;
            ?>
            @endif
    @endforeach

</ul>
<a id="agregar_discursantegrupo1" class="agregar_discursantegrupo1 btn-floating btn-sm waves-effect waves-light blue"><i class="material-icons">add</i></a>
<a id="eliminar_discursantegrupo1" class="eliminar_discursantegrupo1 btn-floating btn-sm waves-effect waves-light red"><i class="material-icons">delete</i></a>



<div class="row margin">
    <div class="input-field col  m12 s12">
        <i class="material-icons prefix ">chrome_reader_mode</i>
        {!! Form::text('himno_intermedio',$sacramental->himno_intermedio,['class'=>'validate input-field','id'=>'himno_intermedio','placeholder'=>'Ingrse Nombre y Numero'])  !!}
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

    <?php
    $total=1;
    ?>
    @foreach($sacramental->oradores as $orador)
        @if($orador->grupo==2)


    <div class="ref_discursantegrupo{!! $total !!}" id="discursantegrupo2num{!! $total !!}">
        <div class="input-field col m6 s12">
            <i class="material-icons prefix">account_circle</i>
            {!! Form::text('tbxdiscursantegrupo2num'.$total,$orador->nombre,['class'=>'validate input-field tbxdiscursante','id'=>'tbxdiscursantegrupo2num'.$total,'placeholder'=>'Nombre completo del Discursante'])  !!}
            <label name="lbldiscursantegrupo2num{!! $total !!}" id="lbldiscursantegrupo2num{!! $total !!}" data-error="dato no valido" data-success="Correcto" class="left-align lbldiscursante">Nombre Discursante</label>
        </div>
        <div class="input-field col m6 s12" id="discursante{!! $total !!}">
            <i class="material-icons prefix">chrome_reader_mode</i>
            {!! Form::text('tbxdiscursantetemagrupo2num'.$total,$orador->tema,['class'=>'validate input-field tbxdiscursantetema','id'=>'tbxdiscursantetemagrupo2num'.$total,'placeholder'=>'Tema'])  !!}
            <label name="lbldiscursantetemagrupo2num{!! $total !!}" id="lbldiscursantetemagrupo2num{!! $total !!}" data-error="dato no valido" data-success="Correcto" class="left-align lbldiscursantetema">Tema Discursante</label>
        </div>
    </div>

                <?php
                $total++;
                ?>
            @endif
        @endforeach

</ul>
<a id="agregar_discursantegrupo2" class="agregar_discursantegrupo2 btn-floating btn-sm waves-effect waves-light blue"><i class="material-icons">add</i></a>
<a id="eliminar_discursantegrupo2" class="eliminar_discursantegrupo2 btn-floating btn-sm waves-effect waves-light red"><i class="material-icons">delete</i></a>
