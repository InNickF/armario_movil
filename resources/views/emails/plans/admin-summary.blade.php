@component('mail::message')
# Atención

Hola ADMINISTRADOR, 

Este es el resumen de los cobros realizados hoy {{Carbon\Carbon::now()}}


PLANES RENOVADOS: {{count($data['success'])}}

PLANES CON ERROR EN EL PAGO: {{count($data['failed'])}}


@if (!empty($data['failed']))
## Errores
@foreach ($data['failed'] as $item)

Usuario:{{$item['user']}}

Subscripcion:{{$item['subscription']}}

Mensaje:{{$item['error']}}

@if (isset($item['result']))
Resultado: {{$item['result']}}
@endif

----------------------------------------------------

@endforeach
@endif

Gracias,<br>
{{ config('app.name') }}
@endcomponent
