@extends('layouts.app')



<style>

</style>
@section('content')
    <div class="container" >
        <div class="row">

            <div class="col s12 m12  card-panel">
                <h4 class="center-align">Carta de Entrevista</h4>

            <iframe src="{!! $ruta !!}" height="100%" width="100%" scrolling="no" frameborder="0" style="border:0" allowfullscreen></iframe>

            </div>


        </div>
    </div>




@endsection
@section('scripts')

@endsection