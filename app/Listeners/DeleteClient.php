<?php

namespace App\Listeners;

use App\Events\DeleteUser;
use App\Models\Cliente;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteClient
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
     * @param  \App\Events\DeleteUser  $event
     * @return void
     */
    public function handle(DeleteUser $event)
    {
        Cliente::where('usuario_id', "=", $event->usuario->id);
    }
}
