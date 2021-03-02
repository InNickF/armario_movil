@component('mail::message')
# Atención

Hola {{$user->full_name}}, 

tu plan "{{$plan->name}}" ha sido renovado con  éxito, el próximo cobro se realizará el {{$subscription->ends_at->format('Y/m/d')}}.

@component('mail::button', ['url' => url('/account/transactions/')])
Ver historial de pagos
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
