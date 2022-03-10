<?php

namespace App\Listeners;

use App\Events\NuevoUsuario;
use App\Mail\NuevoUsuario as MailNuevoUsuario;
use App\Models\Cliente;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class GenerarCliente
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
     * @param  \App\Events\NuevoUsuario  $event
     * @return void
     */
    public function handle(NuevoUsuario $event)
    {
        $clienteEmail = $event->usuario->email;
        Mail::to($clienteEmail)->send(new MailNuevoUsuario($event));

        Cliente::create([
            'cuit' => 'falta completar',
            'razon_social' => $event->usuario->first_name." ".$event->usuario->last_name,
            'telefono' => 'falta completar',
            'direccion' => 'falta completar',
            'usuario_id' => $event->usuario->id
        ]);
    }
}
