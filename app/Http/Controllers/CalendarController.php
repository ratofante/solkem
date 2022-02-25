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
                        'id' => $turno->id,
                        'allDay' => 'false',
                        'title' => $turno->razon_social.' en '.$turno->nombre,
                        'start' => $turno->fechaHora,
                        'end' => '',
                        'description' => $turno->razon_social
                    ];
                }
                return response()->json($turnos);
        }
        //var_dump($request->start); die;
        $data = Turno::select('fechaHora','razon_social','nombre')
            ->join('sucursal', 'turno.sucursal_id','=','sucursal.id')
            ->join('orden','turno.orden_id','=','orden.id')
            ->join('cliente','orden.cliente_id','=','cliente.id')
            ->get();

            $turnos = [];
            foreach($data as $turno) {
                $turnos[]=[
                    //'allDay' => 'false',
                    'title' => substr($turno->fechaHora, 10, 6).' - '.$turno->razon_social.' en '.$turno->nombre,
                    'start' => $turno->fechaHora,
                    'end' => date('Y-m-d G:i',strtotime($turno->fechaHora)+3600)
                ];
                //echo $turno->fechaHora.' - '.date('Y-m-d H:i:s',strtotime($turno->fechaHora)+3600) .'<br>';
            };

            /*foreach($turnos as $e){
                echo $e['start'].'<br>';
                echo date('G:i d-m-Y',strtotime($e['start'])).' - '.date('G:i d-m-Y',strtotime($e['start'])+3600).'<br>';
            }*/

            // Si saco este echo se rompe todo ¿?
            echo "<br><br><br>";
            json_encode($turnos);

        return view('calendar.calendar', ['events' => $turnos]);
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
