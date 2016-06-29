@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="login-page" class="row">
            <div class="col s12 m6 offset-m3 z-depth-1 card-panel">

                <form class="form-horizontal login-form" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12 center">
                            <img src="{!! asset('imagenes/logo.png') !!}" alt="" class="responsive-img valign profile-image-login">
                            <p class="center login-form-text">SIU - Acceso al Sistema</p>
                        </div>
                    </div>


                    <div class="row margin">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            {!! Form::email('email','',['class'=>'validate','id'=>'email','placeholder'=>'Ingresa tu usuario'])  !!}
                            @if ($errors->has('email'))
                                <span class="help-block red-text">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                            <label for="email" data-error="dato no valido" data-success="Correcto" class="left-align">Email</label>
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
                            <label for="password" data-error="dato no valido" data-success="Correcto" class="left-align">Password</label>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="input-field col s12 m12 l12  login-text">
                            <input type="checkbox" id="remember-me" />
                            <label for="remember-me">{!! trans('validation.attributes.remember') !!}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="btn waves-effect waves-light col s12 black">Ingresar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m12 l12">
                            <p class="margin right-align medium-small"><a href="{!! route('password/email') !!}">{!! trans('validation.attributes.forgot_password') !!}</a></p>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
