<div class="">
  <div class="container text-center my-4 pt-4">
    <h2 class="text-primary text-uppercase mb-0 font-weight-bold">TESTIMONIALES</h2>
    <img src="{{asset('/images/logos/gradient-line-short.png')}}" alt="">
  </div>

  <div id="testimonial-slider" class="swiper-container mb-2 mt-3 pb-5">
    <div class="swiper-wrapper p-2">
      
      @foreach ($testimonials as $testimonial)
      <div class="swiper-slide">
        <div class="container">
          <div class="row">

            <div class="itemside col-12 mx-auto">

              <div class="p-0">
                  @include('partials.testimonials.testimonial-card')
              </div>

            </div>
          </div>
        </div>
      </div>

      @endforeach
    </div>
    <div class="swiper-pagination mt-4"></div>
    <!-- Add Arrows -->
    <div class="swiper-button-next d-none d-md-block"></div>
    <div class="swiper-button-prev d-none d-md-block"></div>
  </div>
</div>