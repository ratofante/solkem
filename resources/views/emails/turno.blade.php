@component('mail::message')
# Confirmación de turno para @if ($turno->paraEntrega) envío @else retiro @endif

La fecha designada es: {{ $turno->fechaHora }}

@component('mail::button', ['url' => '/admin/turnos'])
Ver turno
@endcomponent

Gracias, <br>
{{ config('app.name') }}
@endcomponent
