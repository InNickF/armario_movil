@extends('errors::illustrated-layout')

@section('code', '404')
@section('title', __('Página no encontrada'))

@section('image')
<div style="background-image: url({{ asset('/images/404.jpg') }});" class="absolute pin bg-cover bg-center bg-no-repeat h-100 h-50-max h-50">
</div>
@endsection

@section('message', __('¡Upss! Parece que lo que buscas no existe.'))
