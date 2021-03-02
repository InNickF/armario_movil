@extends('layouts.app-front-alt')


@section('content-top')


@include('faqs.faqs-search-bar')

@endsection



@section('content-bottom')
  {{-- @json($faq) --}}
  <div class="text-sm col-md-6 mx-auto mb-0 pl-0 mt-3">
    <small>
  {{ Breadcrumbs::render('pregunta-frecuente', $faq) }}
</small>
</div>
  @include('partials.faqs.faqs-card-large')

@endsection
