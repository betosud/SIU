<section id="content">
    <div class="container" style="min-height: 50px;">
        @if (Session::has('errors'))
            {{--<div class="card-panel grey darken-1">--}}
            <ul class="text-black">
                <strong>Por favor corrigue los siguientes errores: </strong>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            {{--</div>--}}
        @endif
    </div>
</section>