@component('mail::message')
# Atención

Hola ADMINISTRADOR, 

Este es el resumen de los envíos realizados en {{Carbon\Carbon::now()}}

TOTAL PEDIDOS CON PRODUCTOS PENDIENTES: {{$data['pending_orders']}}

@if ($data['pending_orders'] && $data['pending_orders'] > 0)
ENVIADOS EXITOSAMENTE: {{count($data['success']['local']) + count($data['success']['national'])}}
@endif

@if (!empty($data['success']['local']))

## Enviados locales

@foreach ($data['success']['local'] as $result)

Detalle: @json($result)
@endforeach

---------------------------------------

@endif

@if (!empty($data['success']['national']))

## Enviados nacionales

@foreach ($data['success']['national'] as $result)

Detalle: @json($result)

---------------------------------------

@endforeach

@endif


@if ($data['pending_orders'] && $data['pending_orders'] > 0)
NO ENVIADOS: {{count($data['errors']['local']) + count($data['errors']['national'])}}
@endif

@if (!empty($data['errors']['local']))
## No enviados locales

@foreach ($data['errors']['local'] as $error)
Detalle:{{$error}}
@endforeach

---------------------------------------

@endif

@if (!empty($data['errors']['national']))
## No enviados  nacionales

@foreach ($data['errors']['national'] as $error)
Detalle:{{$error}}
@endforeach

---------------------------------------

@endif

Gracias,<br>
{{ config('app.name') }}
@endcomponent
