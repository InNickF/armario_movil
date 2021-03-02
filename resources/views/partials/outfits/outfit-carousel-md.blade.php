<div class="position-relative">
<div class="swiper-slider-5 swiper-container swiper-navigation-offset">
  <div class="swiper-wrapper">

    @foreach ($outfits as $outfit)

    <div class="swiper-slide">
      <div class="w-100 mt-3 mx-2">
        <div class="card my-3">
          <outfit-card :outfit="{{json_encode($outfit)}}">
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