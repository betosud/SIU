@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m12 z-depth-3 card-panel">
                <div class="row">
                    <div class="input-field col s12 center">
                        <h5 class="center login-form-text">Editar Usuario</h5>
                        <h5 class="center login-form-text blue-text">{!! $usuario->name !!}</h5>

                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="blue-text tab col s6"><a href="#datos">Datos</a></li>
                            <li class="blue-text tab col s6"><a href="#permisos">Permisos</a></li>

                        </ul>
                    </div>
                    <div id="datos" class="col s12">
                        @include('layouts.editarusuario')

                    </div>

                    <div id="permisos" class="col s12">
<?php $total=0 ?>
                        @foreach($permisos as $permiso)
        <?php $total++ ?>
                            <div class="col s6">
                                <p>
                                    @if($usuario->can($permiso->slug))
                                        <input onchange="comprobar(this)" checked type="checkbox" id="{!! $permiso->id !!}" value="{!! $usuario->id !!}" />
                                        <label for="{!! $permiso->id !!}">{!!$total." .-".$permiso->name !!}</label>
                                    @else
                                        <input onchange="comprobar(this)" type="checkbox" id="{!! $permiso->id !!}" value="{!! $usuario->id !!}" />
                                        <label for="{!! $permiso->id !!}">{!! $total." .-".$permiso->name !!}</label>
                                    @endif


                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>




    <!-- Modal Structure -->
    <div id="salir" class="modal">
        <div class="modal-content">

            <h5>Si Sale del Modulo no se Guardara los Cambios</h5>
        </div>
        <div class="modal-footer">
            <a href="{!! route('usuarios') !!}" class="modal-action modal-close waves-effect waves-green btn-flat green lighten-2">De Acuerdo</a>
            <a href="#" class="modal-action modal-close waves-effect waves-red btn-flat alert-dismissable red lighten-2">Cancelar</a>
        </div>
    </div>

    {!! Form::open(['route'=>['permisos',':ID',$usuario->id],'method'=>'PUT','id'=>'form-update','class'=>'hide']) !!}
    <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
    {{--<input type="hidden" name="id" value="" id="id">--}}
    {!! Form::close() !!}

@endsection
@section('scripts')
    {!! Html::script('js/permisos.js') !!}

@endsection