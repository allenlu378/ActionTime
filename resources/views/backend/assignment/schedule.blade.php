<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <link href='{{asset('fullcalendar/fullcalendar.min.css')}}' rel='stylesheet' />
    <link href='{{asset('fullcalendar/fullcalendar.print.min.css')}}' rel='stylesheet' media='print' />
    <script src="{{asset("fullcalendar/lib/moment.min.js")}}"></script>
    <script src='{{asset("fullcalendar/lib/jquery.min.js")}}'></script>
    <script src='{{asset('fullcalendar/fullcalendar.min.js')}}'></script>
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                defaultDate: '2019-03-07',
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: <?php echo $result?>,
            });

        });

    </script>
    <style>
        body {
            margin: 40px 10px;
            padding: 0;
            font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }

    </style>
</head>
<body>

<div id='calendar'></div>

</body>
</html>
