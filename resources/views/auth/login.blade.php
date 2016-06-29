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

{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Acceso al Sistema</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                            {{--<label for="password" class="col-md-4 control-label">Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control" name="password">--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox" name="remember"> Remember Me--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--<i class="fa fa-btn fa-sign-in"></i> Login--}}
                                {{--</button>--}}

                                {{--<a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
