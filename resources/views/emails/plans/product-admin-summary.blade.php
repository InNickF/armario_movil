@component('mail::message')
# Atención

Hola ADMINISTRADOR, 

Este es el resumen de los cobros realizados hoy {{Carbon\Carbon::now()}}


PRODUCTOS QUE CADUCARON HOY Y FUERON NOTIFICADOS AL USUARIO: {{count($data['success'])}}

ERRORES EN ENVIO DE NOTIFICACIONES: {{count($data['failed'])}}


@if (!empty($data['failed']))
    ## Errores
    @foreach ($data['failed'] as $item)
    Producto:{{$item['product']}}
    Subscripcion:{{$item['subscription']}}
    Mensaje:{{$item['message']}}
    @if ($item['error'])
    Error: {{$item['error']}}
    @endif
    @endforeach
@endif

Gracias,<br>
{{ config('app.name') }}
@endcomponent
