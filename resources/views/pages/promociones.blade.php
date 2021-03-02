@extends('layouts.home')



@section('content-top')

<div>
<div class="logo-home d-flex justify-content-center align-content-center mt-5 mt-md-0 ">
                  <a href="{{url('/')}}" class="d-inline-block mx-auto mt-3 mb-4">
                    <img src="{{setting('logo_image', asset('images/icons/logo-armario-movil.png'))}}"
                      class="image-svg header-main-logo mx-auto d-block " alt="">
                  </a>
                
  </div>

  {{ Widget::parentCategoryMenu( ['categoryId' => null] ) }}
  @include('partials.top-menu.features')

  @include('partials.home.home-main-slider')
  <div class="container">
    <div class="row">
      <div class="col-12 d-flex flex-wrap flex-column align-content-center justify-content-center">
        <h1 class="text-light text-center">¿Por qué ser Premium?</h1>
        <a class="align-self-center my-3 mb-5 pb-3" href="#promoStart"><img class="align-self-center" src="{{asset('images/arrows/down-arrow.png')}}" alt=""></a>
      </div>
    </div>
  </div>

</div>
@endsection

@section('content-bottom')

@include('partials.promociones.promociones-content')

@endsection