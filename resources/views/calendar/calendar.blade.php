<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css">

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>

    <title>Calendario - Solkem</title>

</head>
<body>
    <div class="container">
        <h2 class="h2 text-center mb-5 border-bottom pb-3">Calendario
        <img class="w-25 h-auto" src="{{ asset('images/logo-solkem.png') }}" alt="Solkem-Logo">
    </h2>
    <div id="calendar"></div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var URL = "{{ url('/') }}";

            var events = @json($events);
            var calendarEl = document.getElementById('calendar');


            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Dia',
                    list: 'Listado',
                },
                slotMinTime: '08:00',
                slotMaxTime: '20:00',
                expandRows: true,
                height: '100%',

                headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                initialView: 'dayGridMonth',
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                selectable: true,
                nowIndicator: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events: events,
                displayEventTime: true,
            });
            calendar.render();
        });
    </script>
</body>
</html>
