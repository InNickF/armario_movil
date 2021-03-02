  <div id="" class="swiper-slider swiper-slider-sm-hide-navs swiper-container mb-5">
    <div class="swiper-wrapper">


      @forelse ($userStore->gallery_images as $imageUrl)
      <div class="swiper-slide">
        <div class="bg-center bg-cover w-100 height-md" style="background-image:url('{{ $imageUrl }}')"></div>
        {{-- <img src="{{ asset('images/sliders/home-slider.png') }}" class="img-fluid" alt=""> --}}
      </div>
      @empty
      <div class="text-center w-100">
      <p class="text-center pt-3">No se han encontrado fotos</p>
      </div>
      @endforelse


    </div>

    {{-- <div class="swiper-pagination"></div> --}}
    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
