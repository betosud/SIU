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
                <div class="card-content black-text">
                    <h5 class="card-title blue-text">Eventos Estaca</h5>
                    <ul class="collection with-header">
                    @foreach($respuesta as $evento)
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

        @if(isset($databarrio['datos']))
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content black-text">
                        <h5 class="card-title blue-text">Eventos Barrio</h5>
                        <ul class="collection with-header">
                            @foreach($databarrio['datos'] as $evento)
                                <li class="collection-item"><div>{!! $evento !!}<a  class="secondary-content black-text"><i class="material-icons">event</i></a></div></li>
                            @endforeach
                        </ul>

                    </div>
                    <div class="card-action">
                        <a href="{!! route('calendario',Auth::user()->idbarrio) !!}">Ver Completo</a>
                        {{--<a href="#">This is a link</a>--}}
                    </div>
                </div>
            </div>
            @endif



    </div>
@endsection
