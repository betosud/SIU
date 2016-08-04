@extends('layouts.app')

<!-- Main Content -->
@section('content')

    <div class="container-fluid">
        <div id="login-page" class="row">
            <div class="col s12 m5 offset-m4 z-depth-1 card-panel">

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12 center">
                            <img src="{!! asset('imagenes/logo.png') !!}" alt="" class="responsive-img valign profile-image-login">
                            <p class="center login-form-text">SIU - Recuperar Contraseña</p>
                        </div>
                    </div>

                    @if(Session::has('status'))

                        <div class="red-text help-block" role="alert">
                            {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                            <strong>Se te ha enviado un correo electronico con instrucciones para restablecer tu contraseña </strong>
                        </div>
                    @endif

                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <label for="email" data-error="dato no valido" data-success="Correcto" class="left-align">Email</label>
                            {!! Form::email('email','',['class'=>'validate','id'=>'email','placeholder'=>'Ingresa tu usuario'])  !!}
                            @if ($errors->has('email'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="btn waves-effect waves-light col s12 black">Recuperar Contraseña</button>
                        </div>
                    </div>


                </form>

            </div>
        </div>
    </div>
@endsection
