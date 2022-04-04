<?php

namespace App\Providers;

use App\Events\DeleteUser;
use App\Events\NuevaOrden;
use App\Events\NuevoUsuario;
use App\Events\TurnoUpdate;
use App\Listeners\AsignarRoles;
use App\Listeners\DeleteClient;
use App\Listeners\GenerarCliente;
use App\Listeners\GenerarEstadoOrden;
use App\Listeners\GenerarTurno;
use App\Listeners\MailNuevoTurno;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NuevoUsuario::class => [
            GenerarCliente::class,
            //AsignarRoles::class,
        ],
        NuevaOrden::class => [
            GenerarTurno::class,
            GenerarEstadoOrden::class,
        ],
        DeleteUser::class => [
            DeleteClient::class,
        ],
        TurnoUpdate::class => [
            MailNuevoTurno::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
