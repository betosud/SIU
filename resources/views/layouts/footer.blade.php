

<div class="row">
<footer class="page-footer grey darken-4">
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col l6 s12">--}}
                {{--@if(!Auth::guest())--}}
                    {{--<h6 class="white-text">{!! Auth::user()->barrionombre !!}</h6>--}}
                {{--@endif--}}
                {{--<p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
    <div class="footer-copyright">
        <div class="container">
            {{--<p class="right">--}}
            @if(!Auth::guest())
                <a class="grey-text text-lighten-4">{!! Auth::user()->barrionombre !!}</a>
            @endif
            {{--</p>--}}
            <a class="grey-text text-lighten-4 right" href="#!">© 2014 Copyright Boligomasoft</a>
        </div>
    </div>
</footer>
</div>