@extends('layouts.app-front-alt')


@section('content-top')

<div class="text-white mb-2 text-center h5">Encuentra la respuesta a todas tus preguntas con Armario</div>

@include('faqs.faqs-search-bar')


@endsection

@section('content-bottom')
<div class="text-sm col-md-6 mx-auto mb-0 pl-0 mt-3"><small>
{{ Breadcrumbs::render('preguntas-frecuentes/categorias', $category) }}
</small>
</div>


  <div class="card col-10 col-md-6 mx-auto my-2 bg-grey px-3 px-md-5">
   
      <div class="aside d-flex flex-wrap align-items-center mb-4 mt-3">
          <img class="img-fluid py-3 img-md-3 mr-2" src="{{ $category->icon_image }}">

        <a href="{{ url('/preguntas-frecuentes/categorias/' . $category->slug) }}">
        <div class="h1 text-primary my-0">{{ $category->name }}</div>
        <div class="text-primary-transparency text-sm mb-0">{!!$category->description!!}</div>
      </a>

    </div>
   
      @foreach ($faqs as $faq)
      @include('partials.faqs.faqs-card')
      @endforeach

    </div>





{{ $titulo }}




@include('partials.faqs.faqs-contact-buttons')


@endsection
