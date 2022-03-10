<?php

namespace App\Listeners;

use App\Events\TurnoUpdate;
use App\Mail\AvisoTurno;
use Brackets\AdminAuth\Models\AdminUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class MailNuevoTurno
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
     * @param  \App\Events\TurnoUpdate  $event
     * @return void
     */
    public function handle(TurnoUpdate $event)
    {
        $orden_id = $event->turno->orden_id;
        $email = AdminUser::select('email')
                    ->join('cliente', 'admin_users.id', '=', 'cliente.usuario_id')
                    ->join('orden', 'cliente.id', '=', 'orden.cliente_id')
                    ->whereIn('orden.id', [$orden_id])
                    ->get();

        Mail::to($email)->send(new AvisoTurno($event));
    }
}
