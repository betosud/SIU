@extends('layouts.app')

@section('contenido')

    <div class="container-fluid">
        <div class="list-group col-md-6">
            <a href="#" class="list-group-item active">
                Proximos Eventos en el Calendario
            </a>

            @foreach($respuesta as $evento)
                <a href="#" class="list-group-item">{!! $evento !!}</a>
            @endforeach


        </div>
        @if(!Auth::guest())


            <div class="list-group col-md-6">
                <a href="#" class="list-group-item active">
                    Notificaciones
                </a>
                <a href="{!! route('sits') !!}" class="list-group-item list-group-item-success">Solicitudes Gasto Nuevas <span class="badge">{!! $countsolicitudes !!}</span></a>
                {{--<a href="#" class="list-group-item">Morbi leo risus</a>--}}
                {{--<a href="#" class="list-group-item">Porta ac consectetur ac</a>--}}
                {{--<a href="#" class="list-group-item">Vestibulum at eros</a>--}}
            </div>
        @endif

        @if(Auth::guest() || !Auth::guest())
            <div class="list-group col-md-6">
                <a href="#" class="list-group-item active">
                    Video Tutoriales
                </a>
                <a href="https://www.youtube.com/watch?v=O36d_pVtPWo" target="_blank" class="list-group-item">Solicitar gasto </a>
                <a href="https://www.youtube.com/watch?v=do4PK7nOR9s" target="_blank" class="list-group-item">Adjuntar archivos a un SIT </a>
                {{--<a href="#" class="list-group-item">Morbi leo risus</a>--}}
                {{--<a href="#" class="list-group-item">Porta ac consectetur ac</a>--}}
                {{--<a href="#" class="list-group-item">Vestibulum at eros</a>--}}
            </div>
        @endif


    </div>
    <div class="container-fluid">
    <div class="list-group col-md-6">
        <a href="#" class="list-group-item active">
            Sitios de la Iglesia
        </a>
{{--<div class="container-fluid col-md-6">--}}

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="{!! asset('imagenes/slider1.png') !!}" alt="" >
                <div class="carousel-caption">
                        <a href="http://www.lds.org" class="h1">Pagina Oficial</a>
                </div>
            </div>
            <div class="item">
                <img src="{!! asset('imagenes/slider2.png') !!}" alt="">
                <div class="carousel-caption">
                    <a href="https://familysearch.org/" class="h1">Family Search</a>
                </div>
            </div>
            <div class="item">
                <img src="{!! asset('imagenes/slider3.png') !!}" alt="">
                <div class="carousel-caption">
                    <a href="https://canalmormon.org/" class="h1">Canal Mormon</a>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    {{--</div>--}}
</div>
</div>
    </div>
@endsection

@section('scripts')

<script>
    $('.carousel').carousel({
        interval: 2000
    })
</script>

@endsection