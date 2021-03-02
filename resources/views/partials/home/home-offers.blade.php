<div class="container py-5">
  <div class="row py-5">
    <div class="col-md-4 col-sm-12 px-0 mx-0">
      <div class="my-1 px-0">
        <a href="{{ setting('home_photo_menu_1_link', null) }}">
          <img src="{{ setting('home_photo_menu_1_image', null) }}" class="img-fluid mx-auto d-block" alt="...">
        </a>
      </div>
      <div class="my-1 px-0">
        <a href="{{ setting('home_photo_menu_2_link', null) }}">
          <img src="{{ setting('home_photo_menu_2_image', null) }}" class="img-fluid mx-auto d-block" alt="...">
        </a>
      </div>
    </div>
    <div class="col-md-4 col-sm-12">

      <div id="home-featured-products-slider" class="swiper-slider swiper-container my-auto">
        <div class="swiper-wrapper">
          @if ($slider)
          @foreach ($slider->slides as $slide)
          <div class="swiper-slide">
            <a href="{{ $slide->url }}">
                <img class="img-fluid" src="{{ $slide->image }}" alt="...">
            </a>
          </div>
          @endforeach
          @endif

        </div>

        {{-- <div class="swiper-pagination"></div> --}}
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </div>

    <div class="col-md-4 col-sm-12 px-0 mx-0">
      <div class="my-1  px-0">
        <a href="{{ setting('home_photo_menu_3_link', null) }}">
          <img src="{{ setting('home_photo_menu_3_image', null) }}" class="img-fluid mx-auto d-block" alt="...">
        </a>
      </div>
      <div class="my-1 px-0">
        <a href="{{ setting('home_photo_menu_4_link', null) }}">
          <img src="{{ setting('home_photo_menu_4_image', null) }}" class="img-fluid mx-auto d-block" alt="...">
        </a>
      </div>
    </div>
  </div>


</div>
