<div class="row margin">
    <div class="input-field col  m6 s12">
        <i class="material-icons prefix ">account_circle</i>
        <label for="bendice1" data-error="dato no valido" data-success="Correcto" class="left-align">Bendice</label>
        {!! Form::text('bendice1',$sacramental->dendice1,['class'=>'validate input-field','id'=>'bendice1','placeholder'=>'Ingrese Nombre Completo'])  !!}
        @if ($errors->has('bendice1'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('bendice1') }}</strong>
                                </span>
        @endif

        <div class="form-group{{ $errors->has('bendice1') ? ' has-error' : '' }}">
        </div>
    </div>

    <div class="input-field col m6 s12">
        <i class="material-icons prefix">account_circle</i>
        <label for="bendice2" data-error="dato no valido" data-success="Correcto" class="left-align">Bendice</label>
        {!! Form::text('bendice2',$sacramental->dendice2,['class'=>'validate input-field','id'=>'bendice2','placeholder'=>'Ingresa el Nombre completo'])  !!}
        @if ($errors->has('bendice2'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('bendice2') }}</strong>
                            </span>
        @endif
        <div class="form-group{{ $errors->has('bendice2') ? ' has-error' : '' }}">
        </div>
    </div>
</div>

<div class="row margin">

    <div class="input-field col  m12 s12">
        <i class="material-icons prefix ">chrome_reader_mode</i>
        <label for="himno_sacramental" data-error="dato no valido" data-success="Correcto" class="left-align">Himno Sacramental</label>
        {!! Form::text('himno_sacramental',$sacramental->himno_sacramental,['class'=>'validate input-field','id'=>'himno_sacramental','placeholder'=>'Ingrse Nombre y Numero'])  !!}
        @if ($errors->has('himno_sacramental'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('himno_sacramental') }}</strong>
                                </span>
        @endif
        <div class="form-group{{ $errors->has('himno_sacramental') ? ' has-error' : '' }}">
        </div>
    </div>
</div>
<div class="row margin">

    <div class="input-field col  m12 s12">
        <i class="material-icons prefix ">group</i>
        <label for="reparten" data-error="dato no valido" data-success="Correcto" class="left-align">Nombres de los que reparten</label>
        <textarea name="reparten" id="reparten" class="materialize-textarea" placeholder="Nombres de Los que reparten">{!! $sacramental->reparten !!}</textarea>
        @if ($errors->has('reparten'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('reparten') }}</strong>
                                </span>
        @endif
        <div class="form-group{{ $errors->has('reparten') ? ' has-error' : '' }}">
        </div>
    </div>


</div>


<ul class="collection">
    <?php
    $total=1;
    ?>
@foreach($sacramental->asuntos as $asunto)
        <div class="ref_asunto input-field col m12 s12" id="asuntosacramental{!! $total !!}">
            <i class="material-icons prefix">event</i>
            <label name="lblanuncio{!! $total !!}" id="lblanuncio{!! $total !!}" data-error="dato no valido" data-success="Correcto" class="left-align lblasunto">Asunto {!! $total !!}</label>
            {!! Form::text('tbxasunto'.$total,$asunto->descripcion,['class'=>'validate input-field tbxasunto','id'=>'tbxasunto'.$total,'placeholder'=>'Descripcion del Asunto'])  !!}

        </div>
            <?php
            $total++;
            ?>
@endforeach



</ul>
<a id="agregar_asunto" class="agregar_asunto btn-floating btn-sm waves-effect waves-light blue"><i class="material-icons">add</i></a>
<a id="eliminar_asunto" class="eliminar_asunto btn-floating btn-sm waves-effect waves-light red"><i class="material-icons">delete</i></a>