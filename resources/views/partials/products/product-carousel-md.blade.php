<div class="position-relative">
<div class="swiper-slider-5 swiper-container swiper-h-auto py-4">
  <div class="swiper-wrapper">

    @foreach ($products as $product)

    <div class="swiper-slide">
      <div class="w-100 mx-2 h-100">

        <div class="card h-100 my-3">
            <product-card :product="{{json_encode($product)}}">
          </div>

      </div>
    </div>

    @endforeach


  </div>
  <!-- Add Arrows -->
</div>
<div class="swiper-button-next swiper-btn-outside-outfit-next swiper-btn-outside-next"></div>
  <div class="swiper-button-prev swiper-btn-outside-outfit-prev swiper-btn-outside-prev"></div>
</div>