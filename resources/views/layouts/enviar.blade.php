<div class="container-fluid col m10">
<div id="enviar" class="modal">
    <div class="modal-content">
        <h4 class="modal-title titulo center-align"></h4>

        <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
        <input type="hidden" name="id" value="" id="id">

        <div class="row margin">
            <div class="input-field col s11 m11">
                <i class="material-icons prefix">account_circle</i>
                <label for="email" data-error="dato no valido" data-success="Correcto" class="left-align">Nombre</label>
                {!! Form::text('nombre','',['class'=>'validate input-field','id'=>'nombre','placeholder'=>'Nombre'])  !!}
                @if ($errors->has('nombre'))
                    <span class="help-block red-text">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                @endif
                <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                </div>
            </div>
        </div>

        <div class="row margin">
            <div class="input-field col s11 m11">
                <i class="material-icons prefix">mail</i>
                <label for="email" data-error="dato no valido" data-success="Correcto" class="left-align">Correo Electronico</label>
                {!! Form::email('email','',['class'=>'validate input-field','id'=>'email','placeholder'=>'nombre@dominio.com'])  !!}
                @if ($errors->has('email'))
                    <span class="help-block red-text">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                @endif
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                </div>
            </div>
        </div>



    </div>
    <div class="modal-footer">
        {!! link_to('#',$title='Enviar',$attributes=['id'=>'enviarcorreo','class'=>'modal-action modal-close waves-effect waves-green btn-flat green lighten-2 ','role'=>'button'],$secure=null) !!}
        <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat alert-dismissable">Cancelar</a>

    </div>
</div>
</div>