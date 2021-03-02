@extends('layouts.home')



@section('content-top')

<div>
<div class="logo-home d-flex justify-content-center align-content-center mt-5 mt-md-0 ">
    <a href="{{url('/')}}" class="d-inline-block mx-auto mt-3 mb-4 ">
      <img src="{{setting('logo_image', asset('images/icons/logo-armario-movil.png'))}}" class="image-svg header-main-logo mx-auto d-block " alt="">
    </a>
  </div>

  {{ Widget::parentCategoryMenu( ['categoryId' => null] ) }}
  @include('partials.top-menu.features')

  @include('partials.home.home-main-slider')
</div>

@endsection



@section('content-bottom')

@if ($top_banner)
@include('partials.banners', [ 'banners' => $top_banner->slides ])
@endif

<div class="container">
  @if ($storesWithActiveStories->count() || (auth()->check() && auth()->user()->hasCompleteStoreProfile()))
  @include('partials.stories.story-carousel-home', ['stores' => $storesWithActiveStories])
  @endif
</div>

<div class="bg-white mt-5">

  <div class="container prod-destacados-home">
      <div class="text-center">
          <h2 class="text-primary mb-0 text-uppercase font-weight-bold">Productos destacados</h2>
          <img src="{{asset('/images/logos/gradient-line-short.png')}}" alt="">
        </div>
    <product-grid :show-filters="false" :plan="'chic'" :only-followed-categories="{{$userHasFollowedCategories ? 'true' : 'false'}}" :limit="8"></product-grid>
  </div>

  @if ($outfits->count())
      
  <div class="container prod-destacados-home">
    <div class="text-center">
      <h2 class="text-primary mb-0 text-uppercase font-weight-bold">Outfits</h2>
      <img src="{{asset('/images/logos/gradient-line-short.png')}}" alt="">
    </div>
    @include('partials.outfits.outfit-carousel-md', ['outfits' => $outfits])
  </div>
  
  @endif

  {{-- FASHION PRODUCTS BIG SLIDER --}}
  <div class="pt-2 mt-3 bg-light">
    <single-product-carousel :only-followed-categories="{{$userHasFollowedCategories ? 'true' : 'false'}}"></single-product-carousel>
  </div>

  {{-- BANNERS --}}
  @include('partials.home.home-offers', [ 'slider' => $offer_slider ])

  @include('partials.home.home-statistics')

  <div class="bg-claro cont-ofertados-home">
    <div class="container text-center my-4 pt-4">
      {{-- Cool: Free plans --}}
      <h2 class="text-primary mb-0 text-uppercase font-weight-bold">Productos ofertados</h2>
      <img src="{{asset('/images/logos/gradient-line-short.png')}}" alt="">
    </div>

    @foreach ($categories as $cat_name => $category_products)
    @if ($category_products->count())
    @include('partials.categories.product-carousel', ['products' => $category_products, 'title' => $cat_name])
    @endif
    @endforeach


  @include('partials.home.home-banners-closet')
      {{ Widget::run('testimonials') }}
  </div>


</div>

@endsection
