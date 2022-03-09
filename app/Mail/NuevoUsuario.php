<?php

namespace App\Mail;

use App\Events\NuevoUsuario as EventsNuevoUsuario;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NuevoUsuario extends Mailable
{
    use Queueable, SerializesModels;


    public $usuario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(EventsNuevoUsuario $event)
    {
        $this->usuario = $event->usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@solkem.com', 'Solkem')
                    ->markdown('emails.bienvenida');
    }
}
