@extends('layouts.app')

@section('content')

    @if(Session::has('message'))
        <script>
            Materialize.toast('{!! Session::get('message') !!}', 3000, 'rounded');
            //            Materialize.toast('test', 3000, 'rounded');
        </script>
    @endif
    <div class="row">
        @if(Auth::guest())
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content black-text">
                        <h5 class="card-title blue-text center-align">Calendario Estaca</h5>
                    <div id='calendarestacafull'></div>
                    </div>
                </div>
            </div>
        @else
    </div>
    <div class="row">
        <div class="col s12 m6">
            <div class="card">
                <div class="card-content black-text">
                    <h6 class="card-title blue-text">Eventos Estaca</h6>
                    <ul class="collection with-header">
                    @foreach($eventosestaca['datos'] as $evento)
                            <li class="collection-item"><div>{!! $evento !!}<a  class="secondary-content black-text"><i class="material-icons">event</i></a></div></li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-action">
                    <a target="_blank" href="http://estacaamecameca.org/calendario-mensual">Ver Completo</a>
                    {{--<a href="#">This is a link</a>--}}
                </div>
            </div>
        </div>

        @if(isset($eventosbarrio['datos']) || isset($sits) || isset($sinvalidar))

                        <div class="col s12 m6">
                            <div class="card">
                                <div class="card-content black-text">
                                    <h6 class="card-title blue-text">Avisos</h6>
                                    <ul class="collapsible " data-collapsible="accordion">
                                        <li>
                                            <div class="collapsible-header"><span class="new badge">{!! count($solicitudes) !!}</span><i class="material-icons">payment</i>Solicitudes de Gasto</div>
                                            <div class="collapsible-body">
                                                <ul class="collection">
                                                    {{--<li class="collection-item">Alvin</li>--}}
                                                    @foreach($solicitudes as $sit)
                                                        <li class="collection-item black-text">Nombre: <strong>{!! $sit->solicitante !!}</strong> Fecha :<strong>{!! $sit->fecha !!}</strong>
                                                            @permission('add.sit')
                                                            <a href="{!! route('crearsit',$sit->id) !!}" class="btn btn-floating waves-effect waves-light blue tooltipped " data-position="top" data-tooltip="Crear Sit"><i class="material-icons ">payment</i></a>
                                                            @endpermission
                                                            @permission('edit.solicitudes')
                                                            <a href="{!! route('editarsolicitud',$sit->id) !!}" class="btn btn-floating waves-effect waves-light green tooltipped " data-position="top" data-tooltip="Editar Solicitud"><i class="material-icons ">edit</i></a>
                                                            @endpermission

                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="collapsible-header"><span class="new badge">{!! count($sinvalidar) !!}</span><i class="material-icons">payment</i>Archivos sin Validar</div>
                                            <div class="collapsible-body">
                                                <ul class="collection">
                                                    {{--<li class="collection-item">Alvin</li>--}}
                                                    @foreach($sinvalidar as $sit)
                                                        <li> <a href="{!! url('editarsit',[$sit->id]) !!}" class="collection-item black-text">Sit: <strong>{!! $sit->idsit !!}</strong> Fecha:<strong>{!! $sit->fechasit !!}</strong></a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="collapsible-header"><span class="new badge">{!! count($sits) !!}</span><i class="material-icons">payment</i>Gastos No completos</div>
                                            <div class="collapsible-body">
                                                <ul class="collection">
                                                    {{--<li class="collection-item">Alvin</li>--}}
                                                    @foreach($sits as $sit)
                                                        <li> <a href="{!! url('editarsit',[$sit->id]) !!}" class="collection-item black-text">Sit: <strong>{!! $sit->idsit !!}</strong> Fecha:<strong>{!! $sit->fechasit !!}</strong>
                                                                Status :<strong>{!! $sit->statusnombre !!}</strong></a></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                                {{--<div class="card-action">--}}
                                {{--<a href="{!! route('calendario',Auth::user()->idbarrio) !!}">Ver Completo</a>--}}
                                {{--</div>--}}
                            </div>
                        </div>

</div>
    <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content black-text">
                        <h6 class="card-title blue-text">Eventos Barrio</h6>
                        <ul class="collection with-header">
                            @foreach($eventosbarrio['datos'] as $evento)
                                <li class="collection-item"><div>{!! $evento !!}<a  class="secondary-content black-text"><i class="material-icons">event</i></a></div></li>
                            @endforeach
                        </ul>

                    </div>
                    <div class="card-action">
                        <a href="{!! route('calendario',Auth::user()->idbarrio) !!}">Ver Completo</a>
                    </div>
                </div>
            </div>
    </div>
        @endif
@endif





@endsection


@section('scripts')
    <script type='text/javascript'>
        $(document).ready(function() {
            $('#calendarestacafull').fullCalendar({
                header: {
                    left: 'prev,next today myCustomButton',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay',
                    lang:'es',

                },
                height: 580,
                weekNumbers:true,
                googleCalendarApiKey: '{{env('APIKEYGOOGLE')}}',
                events: {
                    googleCalendarId: '{{$estaca->nombrecalendario}}'
                }
            });
        });

    </script>
@endsection
