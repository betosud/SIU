<!-- Modal Structure -->
<div id="masivaresultado" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>Resultado</h4>
        <h4>Error</h4>

        @if (count($errors) > 0)
            <ul class="collection">
            @foreach($errors->all() as $error)
                    <li class="collection-item">{!! $error !!}</li>
                @endforeach
            </ul>
            @endif


    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
    </div>
</div>