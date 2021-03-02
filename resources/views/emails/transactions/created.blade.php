@component('mail::message')
# Nueva transacción

Hola {{$transaction->user->full_name ?? '?'}}, se ha generado un {{ $transaction->is_refund ? 'reembolso' : 'cargo' }} en la plataforma.

## Detalles

ID Usuario: {{ $transaction->user->id ?? '?' }}
Nombre Usuario: {{ $transaction->user->full_name ?? '?' }}
Email Usuario: {{ $transaction->user->email ?? '?' }}

Valor: {{ $transaction->is_refund ? '+' : '-' }} @money($transaction->amount)  

@if (!$transaction->is_refund)
ID del transacción: {{$transaction->transaction_id}}  

Código de autorización: {{$transaction->authorization_code}}  
@else
La transacción es un reembolso
@endif

@component('mail::button', ['url' => url('/admin/transactions/' )])
Ver todas las transacciones
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
