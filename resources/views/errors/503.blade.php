{{-- @extends('errors::illustrated-layout')

@section('code', '503')
@section('title', __('Service Unavailable'))

@section('image')
<div style="background-image: url({{ asset('/svg/503.svg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection

@section('message', __($exception->getMessage() ?: 'Sorry, we are doing some maintenance. Please check back soon.'))
 --}}



 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Document</title>
 </head>
 @include('partials.head')
 <body>

     <a href="http://bit.ly/EnviarMensajeAM">
         <img src="{{asset('/images/under-construction.png')}}" alt="" class="w-100">
     </a>
     @include('partials.scripts')
 </body>
 </html>