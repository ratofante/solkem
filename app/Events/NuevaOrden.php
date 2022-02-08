<?php

namespace App\Events;

use App\Models\Orden;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NuevaOrden
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $orden;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Orden $orden)
    {
        $this->orden = $orden;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
