  <div id="home-banner" class="swiper-banner home-banner bg-white swiper-container">
    <div class="swiper-wrapper">

      @forelse ($banners as $banner)
      <div class="swiper-slide">
        <a href="{{ $banner->url }}" class="w-100">
          <img class="w-100" src="{{ $banner->image }}" alt="">
        </a>
      </div>
      @empty
      Banner vacío
      @endforelse
     
    </div>

    <div class="swiper-pagination"></div>
    <!-- Add Arrows -->
    {{-- <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div> --}}
  </div>

