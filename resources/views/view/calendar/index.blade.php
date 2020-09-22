@extends('view.layouts.base')

@section('css')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{asset('plugins/fullcalendar/main.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/fullcalendar-daygrid/main.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/fullcalendar-timegrid/main.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/fullcalendar-bootstrap/main.min.css')}}">
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                <div class="card-body p-0">
                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('scripts')
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <script src="{{asset('plugins/fullcalendar/main.min.js')}}"></script>
  <script src="{{asset('plugins/fullcalendar-daygrid/main.min.js')}}"></script>
  <script src="{{asset('plugins/fullcalendar-timegrid/main.min.js')}}"></script>
  <script src="{{asset('plugins/fullcalendar-interaction/main.min.js')}}"></script>
  <script src="{{asset('plugins/fullcalendar-bootstrap/main.min.js')}}"></script>
 <script>
    $(function () {
      /* initialize the external events
       -----------------------------------------------------------------*/
      function ini_events(ele) {
        ele.each(function () {

          // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
          // it doesn't need to have a start or end
          var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
          }

          // store the Event Object in the DOM element so we can get to it later
          $(this).data('eventObject', eventObject)

          // make the event draggable using jQuery UI
          $(this).draggable({
            zIndex: 1070,
            revert: true, // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
          })

        })
      }

    //   ini_events($('#external-events div.external-event'))

      /* initialize the calendar
       -----------------------------------------------------------------*/
      //Date for the calendar events (dummy data)
      var date = new Date()
      var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear()

      var Calendar = FullCalendar.Calendar;
    //   var Draggable = FullCalendarInteraction.Draggable;

    //   var containerEl = document.getElementById('external-events');
    //   var checkbox = document.getElementById('drop-remove');
      var calendarEl = document.getElementById('calendar');

      // initialize the external events
      // -----------------------------------------------------------------

    //   new Draggable(containerEl, {
    //     itemSelector: '.external-event',
    //     eventData: function (eventEl) {
    //       console.log(eventEl);
    //       return {
    //         title: eventEl.innerText,
    //         backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
    //         borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
    //         textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
    //       };
    //     }
    //   });

      var calendar = new Calendar(calendarEl, {
        plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
        header: {
          left:'',
          center: 'title',
          right: ''
        },
        events: [
          @foreach($list as $index=>$item)
          {
            title: "Gồm: {{$item['count']}} ca",
            start: new Date("{{$item['workday']}}"),
            url: "{{route('calendar.info', $item['workday'])}}",
            backgroundColor: "{{$item['count'] > 0 ? '1px solid #3788d8' : '#f56954'}}",
            borderColor: "{{$item['count'] > 0 ? '1px solid #3788d8' : '#f56954'}}",
            allDay: true
          },
          @endforeach
        ],
      });
      calendar.render();
    });
  </script>
@endsection