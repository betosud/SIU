<!-- Modal subir archivo -->
<div id="uploadfile" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>Agregar Archivo </h4>
        {!! Form::open(['url' => 'guardararchivo','files' => true, 'method' => 'post','id'=>'uploadfileform'])  !!}

        {!! Form::text('idsit',$sit->id,['placeholder'=>'','class'=>'hide','id'=>'idsit']) !!}
        {!! Form::text('token',csrf_token() ,['class'=>'hide','id'=>'token']) !!}



        <div class="input-field col m12 s12">
            <i class="material-icons prefix">description</i>
            {!! Form::text('nombrearchivo','',['class'=>'validate input-field','id'=>'nombrearchivo','placeholder'=>'Ingresa el Nombre del archivo'])  !!}
            @if ($errors->has('nombrearchivo'))
                <span class="help-block red-text">
                                <strong>{{ $errors->first('nombrearchivo') }}</strong>
                            </span>
            @endif
            <label for="nombrearchivo" data-error="dato no valido" data-success="Correcto" class="left-align">Nombre</label>
            <div class="form-group{{ $errors->has('nombrearchivo') ? ' has-error' : '' }}">
            </div>
        </div>


        <div class="input-field col m12 s12">
            <i class="material-icons prefix">description</i>
            {!! Form::text('descripcionarchivo','',['class'=>'validate input-field','id'=>'descripcionarchivo','placeholder'=>'Descripcion del archivo'])  !!}
            @if ($errors->has('descripcionarchivo'))
                <span class="help-block red-text">
                                <strong>{{ $errors->first('descripcionarchivo') }}</strong>
                            </span>
            @endif
            <label for="descripcionarchivo" data-error="dato no valido" data-success="Correcto" class="left-align">Descripcion</label>
            <div class="form-group{{ $errors->has('descripcionarchivo') ? ' has-error' : '' }}">
            </div>
        </div>


        <div class="input-field col m12 s12">
            <i class="material-icons">cloud_upload</i>
            {!! Form::file('archivo', $attributes = array('id'=>'archivo')) !!}
            @if ($errors->has('archivo'))
                <span class="help-block red-text">
                                <strong>{{ $errors->first('archivo') }}</strong>
                            </span>
            @endif
            <label for="archivo" data-error="dato no valido" data-success="Correcto" class="left-align">    </label>
            <div class="form-group{{ $errors->has('archivo') ? ' has-error' : '' }}">
            </div>
        </div>



    </div>
    <div class="modal-footer">
        <button  type="submit" href="#!" class=" waves-effect waves-green btn-flat tooltipped" data-position="top" data-tooltip="Guardar Registro">Guardar</button>
        {{--<a  id="addfile" class="btn-flat waves-effect waves-light green lighten-3" data-position="top" data-tooltip="Guardar"><i class="material-icons">save</i>Guardar</a>--}}
        <a href="#" class="modal-action modal-close waves-effect waves-green btn-flat ">Cancelar</a>

    </div>

    {!! Form::close() !!}
</div>