@component('mail::message')
# Atención

Hola {{$user->full_name}}, ha ocurrido un error cuando hemos intentado renovar tu plan "{{$plan->name}}", por favor ingresa a tu perfil para revisar tu forma de pago.

@component('mail::button', ['url' => url('/account/transactions/')])
Ver historial de pagos
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
