@component('mail::message')
# Nueva solicitud de cobro

Hola ADMINISTRADOR, la tienda {{$store->name}} ha creado una solicitud para cobrar su ganancia


Fecha: {{$date}}

ID de la tienda: {{$store->id}}

ID  del usuario: {{$store->user->id}}

Nombre del usuario: {{$store->user->full_name}}

ID temporal del caso: {{ $paymentRequestId }}


Ganancia activa actual del usuario: USD {{$store->getActiveEarning()}}

@component('mail::button', ['url' => url('/admin/stores/' )])
Administrar tiendas
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
