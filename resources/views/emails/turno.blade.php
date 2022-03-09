@component('mail::message')
# Introduction

The body of your message.
<p>{{ $turno->orden_id }}</p>
<p>{{ $turno->fechaHora }}</p>



@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
