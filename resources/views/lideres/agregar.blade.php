{!! Form::open(array('url' => 'guardarlider', 'method' => 'post','class'=>'form-horizontal','id'=>'form-addlider')) !!}

<div class="form-group">
    {!! Form::text('idbarrio',Auth::user()->idbarrio ,['class'=>'hide','id'=>'idbarrio']) !!}
    {!! Form::text('token',csrf_token() ,['class'=>'hide','id'=>'token']) !!}

</div>
<div class="row margin">
    <div class="input-field col s12">
        <i class="material-icons prefix">account_circle</i>
        {!! Form::text('nombre','',['class'=>'validate required input-field','id'=>'nombre','placeholder'=>'(Obligatorio) Ingresa el Nombre completo'])  !!}
        @if ($errors->has('nombre'))
            <span class="help-block red-text">
                <strong>{{ $errors->first('nombre') }}</strong>
            </span>
        @endif
        <label for="nombre" data-error="dato no valido" data-success="Correcto" class="left-align">Nombre Del Lider</label>
        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
        </div>
    </div>
</div>

<div class="row margin">
    <div class="input-field col s12">
        <i class="material-icons prefix">mail</i>
        {!! Form::email('email','',['class'=>'validate input-field','id'=>'email','placeholder'=>'(Opcional) nombre@dominio.com'])  !!}
        @if ($errors->has('email'))
            <span class="help-block red-text">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        <label for="email" data-error="dato no valido" data-success="Correcto" class="left-align">Correo Electronico</label>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        </div>
    </div>
</div>


<div class="row margin">
    <div class="input-field col s12">
        <i class="material-icons prefix">call</i>
        {!! Form::text('phone','',['class'=>'validate input-field','id'=>'phone','placeholder'=>'(Opcional) Numero de contacto'])  !!}
        @if ($errors->has('phone'))
            <span class="help-block red-text">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
        @endif
        <label for="phone" data-error="dato no valido" data-success="Correcto" class="left-align">Numero de Contacto</label>
        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
        </div>
    </div>
</div>


<div class="row margin">
    <div class="input-field col s12">
        <i class="material-icons prefix">assessment</i>
        {!!  Form::select('llamamiento', $combos['llamamientos'],null,['class'=>'validate input-field','id'=>'llamamiento','placeholder'=>'Selecciona Llamamiento']) !!}
        @if ($errors->has('llamamiento'))
            <span class="help-block red-text">
                <strong>{{ $errors->first('llamamiento') }}</strong>
            </span>
        @endif
        <label for="llamamiento" data-error="dato no valido" data-success="Correcto" class="left-align">Llamamiento SUD</label>
        <div class="form-group{{ $errors->has('llamamiento') ? ' has-error' : '' }}">
        </div>
    </div>
</div>

<div class="row margin">
    <div class="input-field col s12">
        <i class="material-icons prefix">assessment</i>
        {!!  Form::select('organizacion', $combos['organizacion'],null,['class'=>'validate input-field','id'=>'organizacion','placeholder'=>'Selecciona Organizacion']) !!}
        @if ($errors->has('organizacion'))
            <span class="help-block red-text">
                <strong>{{ $errors->first('organizacion') }}</strong>
            </span>
        @endif
        <label for="organizacion" data-error="dato no valido" data-success="Correcto" class="left-align">Organizacion</label>
        <div class="form-group{{ $errors->has('organizacion') ? ' has-error' : '' }}">
        </div>
    </div>
</div>
