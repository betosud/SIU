@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <script>
            Materialize.toast('{!! Session::get('message') !!}', 3000, 'rounded');
            //            Materialize.toast('test', 3000, 'rounded');
        </script>
    @endif
    <div class="row">
        <div class="col s12 m6">
            <div class="card">

                <div class="card-content">

                    <ul class="collection with-header">
                        <li class="collection-header blue-text"><h4>Proximos Eventos</h4></li>
                        @foreach($respuesta as $evento)
                            <li href="#" class="collection-item black-text">{!! $evento !!}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-action">
                    <a target="_blank" href="{!! url('http://estacaamecameca.org/calendario-mensual/') !!}">Ver Calendario Complero</a>
                </div>

            </div>
        </div>
        {{--</div>--}}
        {{--<div class="row">--}}
{{--        @if(Auth::guest() || !Auth::guest())--}}
            <div class="col s12 m6">
                @if(!Auth::guest())
                <div class="card">

                    <div class="card-content">

                        <ul class="collection with-header">
                            <li class="collection-header blue-text"><h4>Notificaciones</h4></li>
                            <li href="{!! route('solicitudes') !!}" class="collection-item"><div>Solicitudes De Gasto<a href="{!! route('solicitudes') !!}"  class="secondary-content"> <span class="new badge">{!! $totalsolicitudes !!}</span> </a></div></li>

                        </ul>

                    </div>
                </div>
                @endif

                <div class="card">

                    <div class="card-content">

                        <ul class="collection with-header">
                            <li class="collection-header blue-text"><h4>Video Tutoriales</h4></li>
                            <li target="_blank" href="https://www.youtube.com/watch?v=O36d_pVtPWo" class="collection-item"><div>Solicitar gasto<a target="_blank" href="https://www.youtube.com/watch?v=O36d_pVtPWo" class="secondary-content"><i class="material-icons">ondemand_video</i></a></div></li>
                            <li target="_blank" href="https://www.youtube.com/watch?v=do4PK7nOR9s" class="collection-item"><div>Adjuntar archivos a un SIT<a target="_blank" href="https://www.youtube.com/watch?v=do4PK7nOR9s" class="secondary-content"><i class="material-icons">ondemand_video</i></a></div></li>
                        </ul>

                    </div>
                </div>
            </div>
        {{--@endif--}}
    </div>




@endsection
