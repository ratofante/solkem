<?php

namespace App\Listeners;

use App\Events\NuevaOrden;
use App\Models\Turno;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerarTurno
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
        Turno::create([
            'orden_id' => $event->orden->id,
            'sucursal_id' => 2,
        ]);
    }
}
