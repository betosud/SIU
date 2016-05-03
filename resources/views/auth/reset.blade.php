@extends('layouts.app')

@section('contenido')


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Restablecer Contraseña</h3>
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    {{ $error }}</div>
                            @endforeach

                        @endif

                            <form class="form-horizontal" method="POST" action="{!! route('/password/reset') !!}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">{!! trans('validation.attributes.email') !!}</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="correo@domino.com">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">{{ trans('validation.attributes.password') }}</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña 6 caracteres">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">{{ trans('validation.attributes.repassword') }}</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repite Contraseña">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Guardar nueva contraseña">
                                            {!! trans('validation.attributes.restore') !!}
                                        </button>
                                        {{--<a href="/" class="btn btn-danger">{!! trans('validation.attributes.exit') !!}</a>--}}
                                        {{--<button href="/" type="button" class="btn btn-danger">{!! trans('validation.attributes.exit') !!}</button>--}}
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
                </div>
            </div>
    </div>





@endsection

@section('scripts')
    {!! Html::script('js/quitaralerta.js') !!}
@endsection