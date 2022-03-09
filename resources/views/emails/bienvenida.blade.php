@component('mail::message')
# Tu usuario ha sido generado con éxito

Ya puedes ingresar a nuestro sitio y chequear los horarios de envío de tus pedidos.

@component('mail::button', ['url' => '/admin/turnos'])
Button Text
@endcomponent

Gracias por preferirnos,<br>
{{ config('app.name') }}
@endcomponent
