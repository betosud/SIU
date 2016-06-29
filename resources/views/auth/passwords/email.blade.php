@extends('layouts.app')

<!-- Main Content -->
@section('content')

    <div class="container">
        <div id="login-page" class="row">
            <div class="col s12 m6 offset-m3 z-depth-1 card-panel">

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


                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="btn waves-effect waves-light col s12 black">Recuperar Contraseña</button>
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
                {{--<div class="panel-heading">Reset Password</div>--}}
                {{--<div class="panel-body">--}}
                    {{--@if (session('status'))--}}
                        {{--<div class="alert alert-success">--}}
                            {{--{{ session('status') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}

                    {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">--}}
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

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--<i class="fa fa-btn fa-envelope"></i> Send Password Reset Link--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
