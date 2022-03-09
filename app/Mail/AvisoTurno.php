<?php

namespace App\Mail;

use App\Events\TurnoUpdate;
use Brackets\AdminAuth\Models\AdminUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AvisoTurno extends Mailable
{

    use Queueable, SerializesModels;

    public $turno;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TurnoUpdate $event)
    {
        $this->turno = $event->turno;
        /*$this->email = AdminUser::select('email')
                    ->join('cliente', 'admin_user.id', '=', 'cliente.usuario.id')
                    ->join('orden', 'cliente.id', '=', 'orden.cliente_id')
                    ->whereIn('orden.id', [$event->turno->orden_id]);*/
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@solkem.com', 'Solkem')
                    ->markdown('emails.turno');
    }
}
