<ul class="collection">


        <div class="ref_asunto input-field col m12 s12" id="asuntosacramental1">
            <i class="material-icons prefix">event</i>
            {!! Form::text('tbxasunto1',"",['class'=>'validate input-field tbxasunto','id'=>'tbxasunto1','placeholder'=>'Descripcion del Asunto'])  !!}
            <label name="lblanuncio1" id="lblanuncio1" data-error="dato no valido" data-success="Correcto" class="left-align lblasunto">Asunto 1</label>
        </div>



</ul>
<a id="agregar_asunto" class="agregar_asunto btn-floating btn-sm waves-effect waves-light blue"><i class="material-icons">add</i></a>
<a id="eliminar_asunto" class="eliminar_asunto btn-floating btn-sm waves-effect waves-light red"><i class="material-icons">delete</i></a>