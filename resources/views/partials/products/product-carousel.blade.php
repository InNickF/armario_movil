
<div id="home-offerted-products-slider" class="swiper-slider-3 swiper-container">
  <div class="swiper-wrapper">


    @foreach ($products as $product)

    <div class="swiper-slide">
      <div class="container mt-3">
        <div class="row">
          <div class="itemside col-12">
              <product-card-sm :product="{{json_encode($product)}}"></product-card-sm>
          </div>

        </div>
      </div>
    </div>

    @endforeach


  </div>
  <!-- Add Arrows -->
  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
</div>
