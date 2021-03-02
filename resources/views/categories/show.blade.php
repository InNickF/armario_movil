@extends('layouts.category')



@section('content-bottom')
@if ($banners_top)

@include('partials.banners', ['banners' => $banners_top])
@endif

<div class="bg-white p-0">
  <div class="container prod-destacados-home">
    <product-grid :show-filters="true"
      :category-id="{{$category->parent_id == null ? $category->id : $category->parent_id}}"
      :sub-category-id="{{$category->parent_id != null ? $category->id : 'null'}}" :plan="'fashion'">
      <div class="container text-center my-4 pt-4">
        <h3 class="text-primary mb-0 text-uppercase titulos">Productos destacados</h3>
        <img src="{{asset('/images/logos/gradient-line-short.png')}}" alt="">
      </div>
    </product-grid>
  </div>

  <div class="container text-center my-4 pt-4">
    <h4 class="text-primary mb-0 text-uppercase titulos">Más en esta categoría</h4>
    <img src="{{asset('/images/logos/gradient-line-short.png')}}" alt="">
  </div>

  <div class="container prod-destacados-home">
    @if ($category->parent_id)
    <product-grid :show-filters="false" :category-id="{{$category->parent_id}}" :subcategory-id="{{$category->id}}" :plan="'chic'"></product-grid>

    @else
    <product-grid :show-filters="false" :category-id="{{$category->id}}" :plan="'chic'"></product-grid>
    @endif
  </div>

  @if ($banners_bottom)
  @include('partials.banners', ['banners' => $banners_bottom])
  @endif


  @if ($cool->count())
  <div class="container text-center my-4 pt-4">
    <h4 class="text-primary mb-0 text-uppercase titulos">Productos relacionados</h4>
    <img src="{{asset('/images/logos/gradient-line-short.png')}}" alt="">
  </div>

  @include('partials.categories.product-carousel', ['products' => $cool, 'title' => $category['name']])
  @endif

  {{--@include('partials.home.home-offers')--}}

  {{ Widget::run('testimonials') }}

</div>
@endsection
