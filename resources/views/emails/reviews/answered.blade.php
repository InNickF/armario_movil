@component('mail::message')
# Atención

Hola {{$answer->review->user->full_name}}, tu reseña "{{$answer->review->body}}" ha recibido una respuesta.

Respuesta:
{{$answer->body}}

@component('mail::button', ['url' => url('/account/reviews/' . $answer->review->id . '/edit')])
Ver detalles
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
