@extends('layouts.app')

@section('content')



<div class="container">
    <div id='calendar'>

    </div>
</div>






@endsection

@section('scripts')
<script type='text/javascript'>
    $(document).ready(function() {



        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today myCustomButton',
                center: 'title',
                right: 'month,agendaWeek,agendaDay',
                lang:'es',

            },

            weekNumbers:true,
            googleCalendarApiKey: '{{env('APIKEYGOOGLE')}}',
            events: {
                googleCalendarId: '{{$barrio->nombrecalendario}}'
            }

        });

    });

</script>
@endsection