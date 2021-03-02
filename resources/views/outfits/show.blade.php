@extends('layouts.app-front')

@section('breadcrumbs')
<div class="col-12 text-sm">
  <small>

    {{ Breadcrumbs::render('outfit', $outfit) }}
  </small>
  </div>
@endsection

@section('content-bottom')

@include('partials.stores.store-header', ['store' => $outfit->store])

<div class="content-i">
  <div class="content-box">
    <div class="element-wrapper">
      <div class="element-box">
      <single-outfit :outfit-param="{{json_encode($outfitArray)}}" user-id="{{auth()->check() ? auth()->user()->id : null}}" @on-add-to-cart="addOutfitToCart"></single-outfit>
      </div>
    </div>
  </div>
</div>

<div class="my-4 pb-4">
    <div class="container text-center mt-5">
        <h4 class="text-primary mb-0 text-uppercase font-weight-bold">PRODUCTOS DEL VENDEDOR</h4>
        <img src="{{asset('/images/logos/gradient-line-short.png')}}" alt="">
      </div>
      
    @include('partials.products.product-carousel', ['products' => $outfit->store->products()->where('is_active', true)->hasStock()->latest()->get()])

    <div class="text-center my-4">
    <a href="{{$outfit->store->url}}" class="btn btn-outline-primary btn-sm font-weight-bold">Ver tienda del vendedor</a>
    </div>
</div>



<div class="my-4 pb-4">
    {{-- Fashion --}}
    <div class="container text-center mt-5">
        <h4 class="text-primary mb-0 text-uppercase font-weight-bold">PRODUCTOS DESTACADOS</h4>
        <img src="{{asset('/images/logos/gradient-line-short.png')}}" alt="">
      </div>
      
      <div class="container-fluid prod-destacados-home">
          @include('partials.products.product-carousel-md', ['products' => $fashion])
      </div>
</div>



<div class="my-4 pb-4">
    {{-- Cool & Chic --}}
    <div class="container text-center mt-5">
        <h4 class="text-primary mb-0 text-uppercase font-weight-bold">PRODUCTOS RELACIONADOS</h4>
        <img src="{{asset('/images/logos/gradient-line-short.png')}}" alt="">
      </div>
      
      <div class="container-fluid prod-destacados-home">
          @include('partials.products.product-carousel', ['products' => $cool_chic])
      </div>
</div>



@if (auth()->check() && $recently_viewed->count())    
<div class="my-4 pb-4">
    {{-- Cool & Chic --}}
    <div class="container text-center mt-5">
        <h4 class="text-primary mb-0 text-uppercase font-weight-bold">PRODUCTOS VISTOS RECIENTEMENTE</h4>
        <img src="{{asset('/images/logos/gradient-line-short.png')}}" alt="">
      </div>
      
      <div class="container-fluid prod-destacados-home">
          @include('partials.products.product-carousel', ['products' => $recently_viewed])
      </div>
</div>
@endif



<div class="bg-white p-0">

  {{ Widget::run('testimonials') }}

</div>
@endsection
