@extends('layouts.app-front-alt')

@section('content-top')

{{ Widget::parentCategoryMenu( ['categoryId' => null] ) }}

@include('partials.stores.store-header-main', ['store'=> $userStore])

@endsection

@section('content-bottom')

<div class="tab-content mt-0 pt-0 pt-lg-1" id="myTabContent">

  {{-- Tab  --}}
  <div class="tab-pane fade {{ !request()->has('about') ? 'show active' : ''}}" id="store-products" role="tabpanel">
    <div id="store-products" class="container prod-destacados-home pt-5">

      <product-grid :show-filters="true" store-id="{{$userStore->id}}"
        :store-has-stories="{{$userStore->active_stories->count() > 0 ? 'true' : 'false'}}" :show-more-btn="true" :limit="12"></product-grid>

    </div>
  </div>

  {{-- Tab  --}}
  <div class="tab-pane fade" id="reviews" role="tabpanel">
    <store-review-list :store-id="{{ $userStore->id }}" ref="reviewList"></store-review-list>
  </div>

  {{-- Tab  --}}
  <div class="tab-pane fade {{ request()->has('about') ? 'show active' : ''}}" id="about" role="tabpanel">
    <div class="container pt-4">

      <div class="row mt-5">
        <div class="col-lg-8 mx-auto">
          <h1 class="text-primary">Sobre nosotros</h1>
          <p>{{ $userStore->description }}</p>
        </div>
        <div class="col-md-4">
          @include('partials.stores.photo-carousel')
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <store-gallery :store-prop="{{json_encode($userStore)}}"></store-gallery>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="bg-white p-0">

  {{ Widget::run('testimonials') }}

</div>
@endsection
