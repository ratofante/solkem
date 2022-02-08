<?php

namespace App\Listeners;

use App\Events\NuevaOrden;
use App\Models\Cliente;
use App\Models\EstadoOrden;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerarEstadoOrden
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NuevaOrden  $event
     * @return void
     */
    public function handle(NuevaOrden $event)
    {
        $usuario_id = Cliente::select('usuario_id')->where('id',"=",$event->orden->cliente_id)->get();
        EstadoOrden::create([
            'usuario_id' => $usuario_id[0]->usuario_id,
            'orden_id' => $event->orden->id,
            'estado_id' => 1,
        ]);
    }
}
