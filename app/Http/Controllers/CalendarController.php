<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolkemEvents;
use App\Models\Turno;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            /*$data = SolkemEvents::whereDate('event_start', '>=', $request->start)
                ->whereDate('event_end',   '<=', $request->end)
                ->get(['id', 'event_name', 'event_start', 'event_end']);

                $events=[];
                foreach($data as $event) {
                    $events[]=[
                        'title' => $event->event_name,
                        'start' => $event->event_start,
                        'end' => $event->event_end
                    ];
                }*/

            $data = Turno::select('fechaHora','razon_social','nombre')
                ->whereDate('fechaHora', '>=', $request->start)
                ->join('sucursal', 'turno.sucursal_id','=','sucursal.id')
                ->join('orden','turno.orden_id','=','orden.id')
                ->join('cliente','orden.cliente_id','=','cliente.id')
                ->get();

                $turnos = [];
                foreach($data as $turno) {
                    $turnos[]=[
                        'allDay' => 'true',
                        'title' => $turno->razon_social.' en '.$turno->nombre,
                        'start' => $turno->fechaHora,
                        'end' => ''
                    ];
                }

                return response()->json($turnos);


                //return response()->json($data);

                //return response()->json($events);
        }



        /*$turnos = Turno::all();
        $horarios = [];
        foreach( $turnos as $turno ) {
            $horarios[] = [
                'id' => $turno->id,
                'horario' => $turno->fechaHora
            ];
        }*/
        //dd($data);
        //var_dump(json_encode($horarios));
        return view('calendar.index');
    }

    public function calendarEvents(Request $request)
    {

        switch ($request->type) {
           case 'create':
              $event = SolkemEvents::create([
                  'event_name' => $request->event_name,
                  'event_start' => $request->event_start,
                  'event_end' => $request->event_end,
              ]);

              return response()->json($event);
             break;

           case 'edit':
              $event = SolkemEvents::find($request->id)->update([
                  'event_name' => $request->event_name,
                  'event_start' => $request->event_start,
                  'event_end' => $request->event_end,
              ]);

              return response()->json($event);
             break;

           case 'delete':
              $event = SolkemEvents::find($request->id)->delete();

              return response()->json($event);
             break;

           default:
             # ...
             break;
        }
    }
}
