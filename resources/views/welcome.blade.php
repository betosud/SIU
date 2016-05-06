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


        <div class="list-group col-md-6">
            <a href="#" class="list-group-item active">
                Formatos Para descargar
            </a>
            {{--<a href="#" class="list-group-item">Dapibus ac facilisis in</a>--}}
            {{--<a href="#" class="list-group-item">Morbi leo risus</a>--}}
            {{--<a href="#" class="list-group-item">Porta ac consectetur ac</a>--}}
            {{--<a href="#" class="list-group-item">Vestibulum at eros</a>--}}
        </div>

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