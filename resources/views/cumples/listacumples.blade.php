<table class="bordered responsive-table highlight">
    <thead>
    <tr>
        <th data-field="nombre">Nombre</th>
        <th data-field="fecha">Fecha Cumpleaños</th>
        <th data-field="edad">Edad</th>
        <th data-field="acciones">acciones</th>
    </tr>
    </thead>

    <tbody>

    @foreach($cumples as $cumple)
        <tr data-id={!! $cumple->id !!}>
            <td>{!!$cumple->nombre !!}</td>
            <td>{!!$cumple->fechacumple !!}</td>
            <td>{!!$cumple->edad !!}</td>


            <td>

                @permission('edit.cumples')
                <a OnClick='mostrar(this)' id="{!! $cumple->id !!}" href="#editar" class="btn btn-floating waves-effect waves-light blue tooltipped modal-trigger" data-position="top" data-tooltip="Editar"><i class="material-icons ">edit</i></a>
                @endpermission
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="pagination">

    {!! $cumples->render() !!}

</div>