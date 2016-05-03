@extends('layouts.app')


@section('contenido')


    <div class="container-fluid">
        <div class="col-md-8 col-lg-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Registro Exitoso</h3>
                </div>

                <ul class="list-group">
                    <li class="list-group-item">Barrio:<strong>{!! $barrio->nombreunidad !!}</strong></li>
                    <li class="list-group-item">Numero de Solicitud: <strong>{!! $solicitud->id !!}</strong></li>
                    <li class="list-group-item">Nombre de Solicitante: <strong>{!! $solicitud->solicitante !!}</strong></li>
                    <li class="list-group-item">Descripcion: <strong>{!! $solicitud->descripcion !!}</strong></li>
                    <li class="list-group-item">Cantidad: <strong>{!! $solicitud->cantidad !!}</strong></li>
                    <li class="list-group-item">Organizacion: <strong>{!! $solicitud->organizacionnombre !!}</strong></li>
                    <li class="list-group-item">Tipo de Pago: <strong>{!! $solicitud->tipopagonombre !!}</strong></li>
                </ul>

            </div>
        </div>
    </div>
@endsection

@section('scripts')


@endsection