@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <script>
            Materialize.toast('{!! Session::get('message') !!}', 3000, 'rounded');
            //            Materialize.toast('test', 3000, 'rounded');
        </script>
    @endif
    <div class="container-fluid">
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

                            <ul class="collapsible" data-collapsible="accordion">

                                @if(count($solicitudes)>0)
                                    <li>
                                        <div class="collapsible-header"><span class="new badge">{!! count($solicitudes) !!}</span><i class="material-icons">card_membership</i>Solicitudes De Gasto</div>
                                        <div class="collapsible-body">

                                                <div class="collection">
                                                @foreach($solicitudes as $solicitud)
                                                <a class="collection-item black-text">
                                                        {!! $solicitud->id !!} {!! $solicitud->solicitante !!}
                                                </a>
                                                @endforeach
                                                </div>

                                        </div>
                                    </li>
                                @endif
                                    @if(count($sits)>0)
                                        <li>
                                            <div class="collapsible-header"><span class="new badge">{!! count($sits) !!}</span><i class="material-icons">payment</i>Gastos Incompletos</div>
                                            <div class="collapsible-body">
                                                <div class="collection">
                                                    @foreach($sits as $sit)
                                                        <a href="{!! route('editarsit',$sit->id) !!}" class="collection-item black-text">
                                                            id:<strong>{!! $sit->idsit !!}</strong> Fecha: <strong>{!! $sit->fechasit !!}</strong> Status: <strong>{!! $sit->statusnombre !!}</strong>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    @endif




                            </ul>






                        </ul>
                        {{--<ul class="collapsible" data-collapsible="accordion">--}}
                            {{--@if(count($solicitudes)>0)--}}
                            {{--<li>--}}
                                {{--<div class="collapsible-header"><span class="new badge">1</span><i class="material-icons">filter_drama</i>Solicitudes De Gasto</div>--}}
                                {{--<div class="collapsible-body">--}}
                                    {{--<p>--}}
                                    {{--<ul class="collection with-header">--}}


                                    {{--</ul>--}}
                                    {{--</p>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                            {{--@endif--}}
                            {{--<li>--}}
                                {{--<div class="collapsible-header"><i class="material-icons">place</i>Second</div>--}}
                                {{--<div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<div class="collapsible-header"><i class="material-icons">whatshot</i>Third</div>--}}
                                {{--<div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}

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

    </div>
@endsection
