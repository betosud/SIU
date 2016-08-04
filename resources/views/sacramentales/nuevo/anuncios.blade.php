<ul class="collection">
    <?php
        $total=1;
    ?>
    @foreach($anucnios_sacramental as $anuncio)

            <div class="ref_anuncio input-field col m12 s12" id="anunciosacramental{!! $total !!}">
                <i class="material-icons prefix">event</i>
                <label name="lblanuncio{!! $total !!}" id="lblanuncio{!! $total !!}" data-error="dato no valido" data-success="Correcto" class="left-align lblanuncio">Anuncio {!! $total !!}</label>
                {!! Form::text('tbxanuncio'.$total,$anuncio,['class'=>'validate input-field tbxanuncio','id'=>'tbxanuncio'.$total,'placeholder'=>'Descripcion del Anuncio'])  !!}
            </div>

            <?php
            $total++;
            ?>
    @endforeach

</ul>
<a id="agregar_anuncio" class="agregar_anuncio btn-floating btn-sm waves-effect waves-light blue"><i class="material-icons">add</i></a>
<a id="eliminar_anuncio" class="eliminar_anuncio btn-floating btn-sm waves-effect waves-light red"><i class="material-icons">delete</i></a>