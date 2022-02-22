<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Craftable') - {{ trans('brackets/admin-ui::admin.page_title_suffix') }}</title>

    <!-- bootstrap 5 -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->

    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>

    <!-- probé con estos para iniciarlos según los docs de la página. No me funcionó -->
    <!--
    <link href='{{ asset('css/fullcalendar.css') }}' rel='stylesheet' />
    <script src='{{ asset('js/fullCalendar/fullcalendar.js') }}'></script>
    -->

    <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}">
</head>
<body>


    <div class="container">
        <div id="calendar"></div>
    </div>

    <!-- day click dialog -->
        <div id="dialog" class="">
            <div id="dialog-body">
                <form id="dayClick" action="" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nOrden">Orden</label>
                        <input type="text" id="nOrden" class="form-control" name="title" placeholder="N° de Orden">
                    </div>
                    <div class="form-group">
                        <label for="start">Fecha Turno</label>
                        <input type="text" name="start" id="fecha" placeholder="fecha">
                    </div>
                </form>
            </div>
        </div>




    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous"></script>

    <!-- moment Js -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>

    <!-- jquery ui -->
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <!-- full calendar js -->
    <script src="{{ asset('js/fullcalendar.js') }}"></script>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                themeSystem: 'bootstrap5',
                selectable: true,
                height: 650,
                showNonCurrentDates: false,
                editable: false,
                defaultView: 'month',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right:'month,basicWeek,basicDay'
                },
                dayClick:function(date, event, view) {
                    $('#dialog').dialog({
                        title:'Asignar turno',
                        width: 600,
                        height: 700,
                        modal: true,
                        buttons: {
                            Close:function() {
                                $(this).dialog('close');
                            }
                        },
                        show:{effect:'clip', duration:350},
                        hide:{effect:'clip', duration:250}
                    });
                }
            });
        })

        //Fracaso rotundo..
        /*$(document).ready(function () {
            calendarEl = $('#calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });*/
    </script>
    <script scr="{{ asset('js/app.js') }}"></script>
</body>
</html>
