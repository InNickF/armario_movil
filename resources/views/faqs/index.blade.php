@extends('layouts.app-front-alt')


@section('content-top')


<div class="text-white mb-2 text-center h5">Encuentra la respuesta a todas tus preguntas con Armario</div>

@include('faqs.faqs-search-bar')


@endsection

@section('content-bottom')

{{-- {{ Breadcrumbs::render('preguntas-frecuentes') }} --}}


@if (!$search)
@include('partials.faqs.faqs-categories-buttons')

@include('partials.faqs.faqs-category-box')


<div class="text-center mt-5 mb-4 text-primary h2">Preguntas frecuentes</div>

<div class="col-10 col-md-6 mx-auto">
	@foreach ($faqs as $faq)
	@include('partials.faqs.faqs-card')
	@endforeach
</div>
@else
{{-- Is Search --}}

<div class="col-md-6 mx-auto mt-5 mb-3">
	
	<div class="text-sm text-primary-transparency">Resultados de:</div>
	<div class="h3 text-primary">{{$search}}</div>
</div>

<div class="col-10 col-md-6 mx-auto">
	@foreach ($faqs as $faq)
	@include('partials.faqs.faqs-card')
	@endforeach
</div>
@endif




@include('partials.faqs.faqs-contact-buttons')


@endsection
