@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col s12 m12 z-depth-3 card-panel">
                @if(Session::has('message'))
                    <script>
                        Materialize.toast('{!! Session::get('message') !!}', 3000, 'rounded');
                    </script>
                @endif
                <div class="row">
                    <div class="input-field col s12 center">
                        <h4 class="center login-form-text">Programas Bautizmales</h4>
                    </div>
                </div>
                @permission('add.bautizmal')
                <a href="{!! route('nuevobautizmal') !!}" class="btn btn-floating waves-effect waves-light blue lighten-2 tooltipped " data-position="left" data-tooltip="Nuevo Programa"><i class="material-icons ">add</i></a>
                @endpermission
                <div class="discursos">

                    <table class="bordered responsive-table highlight">
                        <thead>
                        <tr>
                            <th data-field="id">Bautizmo de</th>
                            <th data-field="name">Fecha</th>
                            <th data-field="price">Hora</th>
                            <th data-field="price">Acciones</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($bautizmales as $bautizmal)
                            <tr data-id={!! $bautizmal->id !!}>
                                <td>{!!$bautizmal->bautizmode !!}</td>
                                <td>{!!$bautizmal->fechadma !!}</td>
                                <td>{!!$bautizmal->horahm !!}</td>
                                <td>
                                    {{--<a href="{!! route('pdfdiscurso',[$discurso->id,'descargar',$discurso->token]) !!}" class="btn btn-floating waves-effect waves-light black tooltipped " data-position="top" data-tooltip="Imprimir"><i class="material-icons ">print</i></a>--}}
                                    @permission('edit.bautizmal')
                                    <a href="{!! route('editarbautizmal',$bautizmal->id) !!}" class="btn btn-floating waves-effect waves-light green tooltipped " data-position="top" data-tooltip="Editar"><i class="material-icons ">edit</i></a>
                                    @endpermission
                                    @permission('print.bautizmal')
                                    <a  href="{!! route('pdfbautizmal',[$bautizmal->id,'descargar']) !!}" class="btn btn-floating waves-effect waves-light blue tooltipped modal-trigger" data-position="top" data-tooltip="Imprimir"><i class="material-icons ">print</i></a>
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="pagination">

                        {!! $bautizmales->render() !!}

                    </div>
                    {!! Html::script('js/utiles.js') !!}
                </div>


            </div>
        </div>
    </div>


    @include('layouts.loading')

@endsection
@section('scripts')

    {!! Html::script('js/paginacion.js') !!}
@endsection