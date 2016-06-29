{!! Form::model($sit,['route' => ['actualizarsit',$sit->id], 'method' => 'PUT','class'=>'form-horizontal']) !!}


<div class="row margin">
    <div class="input-field col  m4 s12">
        <i class="material-icons prefix ">event</i>
        {!! Form::text('fechasit',$sit->fechasit,['class'=>'validate input-field datepicker','id'=>'datepicker','placeholder'=>'Seleeciona Fecha'])  !!}
        @if ($errors->has('fechasit'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('fechasit') }}</strong>
                                </span>
        @endif
        <label for="fechasit" data-error="dato no valido" data-success="Correcto" class="left-align">Fecha</label>
        <div class="form-group{{ $errors->has('fechasit') ? ' has-error' : '' }}">
        </div>
    </div>

    <div class="input-field col m8 s12">
        <i class="material-icons prefix">account_circle</i>
        {!! Form::text('solicitante',$sit->solicitante,['class'=>'validate input-field','id'=>'solicitante','placeholder'=>'Ingresa el Nombre completo'])  !!}
        @if ($errors->has('nombre'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('solicitante') }}</strong>
                            </span>
        @endif
        <label for="solicitante" data-error="dato no valido" data-success="Correcto" class="left-align">Solicitante</label>
        <div class="form-group{{ $errors->has('solicitante') ? ' has-error' : '' }}">
        </div>
    </div>

</div>

<div class="row margin">

    <div class="input-field col m6 s12">
        <i class="material-icons prefix">account_circle</i>
        {!! Form::text('pagable',$sit->pagable,['class'=>'validate input-field','id'=>'pagable','placeholder'=>'Nombre Completo'])  !!}
        @if ($errors->has('pagable'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('pagable') }}</strong>
                            </span>
        @endif
        <label for="pagable" data-error="dato no valido" data-success="Correcto" class="left-align">Pagable</label>
        <div class="form-group{{ $errors->has('pagable') ? ' has-error' : '' }}">
        </div>
    </div>

    <div class="input-field col m3 s12">
        <i class="material-icons prefix">mail</i>
        {!! Form::email('mail',$sit->mail,['class'=>'validate input-field','id'=>'mail','placeholder'=>'nombre@dominio.com'])  !!}
        @if ($errors->has('mail'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('mail') }}</strong>
                            </span>
        @endif
        <label for="mail" data-error="dato no valido" data-success="Correcto" class="left-align">Correo Electronico</label>
        <div class="form-group{{ $errors->has('mail') ? ' has-error' : '' }}">
        </div>
    </div>
    <div class="input-field col m3 s12">
        <i class="material-icons prefix">credit_card</i>
        {!! Form::text('ife',$sit->ife,['class'=>'validate input-field','id'=>'ife','placeholder'=>'13 digitos'])  !!}
        @if ($errors->has('ife'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('ife') }}</strong>
                            </span>
        @endif
        <label for="ife" data-error="dato no valido" data-success="Correcto" class="left-align">Numero de IFE</label>
        <div class="form-group{{ $errors->has('ife') ? ' has-error' : '' }}">
        </div>
    </div>
</div>

<div class="row margin">
    <div class="input-field col m8 s12">
        <i class="material-icons prefix">description</i>
        {!! Form::text('descripcion',$sit->descripcion,['class'=>'validate input-field','id'=>'descripcion','placeholder'=>'Descripcion de la Actividad'])  !!}
        @if ($errors->has('descripcion'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('descripcion') }}</strong>
                            </span>
        @endif
        <label for="descripcion" data-error="dato no valido" data-success="Correcto" class="left-align">Descripcion del Gasto</label>
        <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
        </div>
    </div>

    <div class="input-field col m4 s12">
        <i class="material-icons prefix">attach_money</i>
        {!! Form::text('cantidad',$sit->cantidad,['class'=>'validate input-field','id'=>'cantidad','placeholder'=>'Cantidad'])  !!}
        @if ($errors->has('cantidad'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('cantidad') }}</strong>
                            </span>
        @endif
        <label for="cantidad" data-error="dato no valido" data-success="Correcto" class="left-align">Cantidad</label>
        <div class="form-group{{ $errors->has('cantidad') ? ' has-error' : '' }}">
        </div>
    </div>



</div>

<div class="row margin">
    <div class="input-field col m4 s12">
        <i class="material-icons prefix ">library_books</i>
        {!!  Form::select('organizaciongasto', $combos['organizacion'],null,['placeholder'=>'Selecciona Organizacion','class'=>'validate input-field organizaciongasto','id'=>'organizaciongasto']) !!}
        @if ($errors->has('organizaciongasto'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('organizaciongasto') }}</strong>
                            </span>
        @endif
        <label for="organizaciongasto" data-error="dato no valido" data-success="Correcto" class="left-align ">Organizacion</label>
        <div class="form-group{{ $errors->has('organizaciongasto') ? ' has-error' : '' }}">
        </div>
    </div>

    <div class="input-field col  m4 s12">
        <i class="material-icons prefix ">library_books</i>
        {!!  Form::select('categoria',$combos['categoria'],null,['placeholder'=>'Selecciona Categoria','id'=>'categoria','class'=>'validate input-field']) !!}
        @if ($errors->has('categoria'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('categoria') }}</strong>
                                </span>
        @endif
        <label for="categoria" data-error="dato no valido" data-success="Correcto" class="left-align">Categoria</label>
        <div class="form-group{{ $errors->has('categoria') ? ' has-error' : '' }}">
        </div>
    </div>

    <div class="input-field col m4 s12">
        <i class="material-icons prefix ">library_books</i>
        {!!  Form::select('tipopago', $combos['tipopago'],null,['placeholder'=>'Selecciona Tipo de pago','class'=>'validate input-field','id'=>'tipopago']) !!}
        @if ($errors->has('tipopago'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('tipopago') }}</strong>
                            </span>
        @endif
        <label for="tipopago" data-error="dato no valido" data-success="Correcto" class="left-align">Tipo de Pago</label>
        <div class="form-group{{ $errors->has('tipopago') ? ' has-error' : '' }}">
        </div>
    </div>

</div>

<div class="row margin">

    <div class="input-field col  m6 s12">
        <i class="material-icons prefix ">account_circle</i>
        {!!  Form::select('pteorganizacion',$combos['lideres'],null,['placeholder'=>'Selecciona Lider','id'=>'pteorganizacion','class'=>'pteorganizacion']) !!}
        @if ($errors->has('pteorganizacion'))
            <span class="help-block red-text">
                        <strong>{{ $errors->first('pteorganizacion') }}</strong>
                        </span>
        @endif
        <label for="pteorganizacion" data-error="dato no valido" data-success="Correcto" class="left-align">Pte. Organizacion</label>
        <div class="form-group{{ $errors->has('pteorganizacion') ? ' has-error' : '' }}">
        </div>
    </div>


    <div class="input-field col  m6 s12">
        <i class="material-icons prefix ">account_circle</i>
        {!!  Form::select('obispo',$combos['obispado'],null,['placeholder'=>'Selecciona Lider','id'=>'obispo','class'=>'obispo']) !!}
        @if ($errors->has('obispo'))
            <span class="help-block red-text">
                        <strong>{{ $errors->first('obispo') }}</strong>
                        </span>
        @endif
        <label for="obispolabel" data-error="dato no valido" data-success="Correcto" class="left-align">Lider Obispado</label>
        <div class="form-group{{ $errors->has('obispo') ? ' has-error' : '' }}">
        </div>
    </div>

</div>

<div class="row margin">
    <div class="input-field col m8 s12">
        <i class="material-icons prefix">description</i>
        {!! Form::text('observaciones',$sit->observaciones,['class'=>'validate input-field','id'=>'observaciones','placeholder'=>'Observaciones'])  !!}
        @if ($errors->has('observaciones'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('observaciones') }}</strong>
                            </span>
        @endif
        <label for="observaciones" data-error="dato no valido" data-success="Correcto" class="left-align">Observaciones del Gasto</label>
        <div class="form-group{{ $errors->has('observaciones') ? ' has-error' : '' }}">
        </div>
    </div>



    <div class="input-field col  m4 s12">
        <i class="material-icons prefix">description</i>
        {!!  Form::select('status',$combos['statussit'],null,['placeholder'=>'Status','id'=>'status','class'=>'status']) !!}
        @if ($errors->has('status'))
            <span class="help-block red-text">
                        <strong>{{ $errors->first('status') }}</strong>
                        </span>
        @endif
        <label for="status" data-error="dato no valido" data-success="Correcto" class="left-align">Status del Sit</label>
        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
        </div>
    </div>

</div>


<div class="row">
    <div class="input-field col s4 m6 left">
        <button type="submit" class="btn waves-effect waves-light col s12 grey darken-1 tooltipped" data-position="top" data-tooltip="Guardar Registro"> <i class="material-icons">save</i>Guardar</button>
    </div>
    {{--</div>--}}
    {{--<div class="row">--}}
    <div class="input-field col s4 m6 left">
        <a href="#salir"  class="btn waves-effect waves-light col s12 red lighten-2 tooltipped modal-trigger" data-position="top" data-tooltip="Salir del Modulo"><i class="material-icons">cancel</i>Cancelar</a>
    </div>
</div>


{!! Form::Close() !!}