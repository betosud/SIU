@extends('layouts.app')

@section('content')


    <div class="container">
        <div id="login-page" class="row">
            <div class="col s12 m6 offset-m3 z-depth-1 card-panel">

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12 center">
                            <img src="{!! asset('imagenes/logo.png') !!}" alt="" class="responsive-img valign profile-image-login">
                            <p class="center login-form-text">SIU - Establecer Contraseña</p>
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
                            {!! Form::email('email','',['class'=>'validate','id'=>'email','placeholder'=>'Ingresa tu usuario'])  !!}


                            <input type="hidden" name="token" value="{{ $token }}">
                            @if ($errors->has('email'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                            <label for="email" data-error="dato no valido" data-success="Correcto" class="left-align">{!! trans('validation.attributes.email') !!}</label>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            </div>
                        </div>
                    </div>



                    <div class="row margin">

                        <div class="input-field col s12">
                            <i class="material-icons prefix">lock</i>
                            {!! Form::password('password','',['class'=>'awesome','id'=>'password','placeholder'=>'ingresa tu contraseña'])  !!}
                            @if ($errors->has('password'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                            <label for="password" data-error="dato no valido" data-success="Correcto" class="left-align">{!! trans('validation.attributes.password') !!}</label>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            </div>
                        </div>
                    </div>


                    <div class="row margin">

                        <div class="input-field col s12">
                            <i class="material-icons prefix">lock</i>
                            {!! Form::password('password_confirmation','',['class'=>'awesome','id'=>'password_confirmation','placeholder'=>'ingresa tu contraseña'])  !!}
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                            <label for="password_confirmation" data-error="dato no valido" data-success="Correcto" class="left-align">{!! trans('validation.attributes.repassword') !!}</label>
                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="btn waves-effect waves-light col s12 black">Guardar Nueva Contraseña</button>
                        </div>
                    </div>


                </form>

            </div>
        </div>
    </div>
@endsection
