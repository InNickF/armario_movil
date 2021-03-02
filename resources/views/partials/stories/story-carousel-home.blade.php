

<div class="text-center font-weight-bold text-primary mt-5 mb-3">
  <h2>OFERTAS 24 HORAS</h2>
</div>
<div class="bg-gradient-blue rounded-md">
  <div class="swiper-stories swiper-container card bg-white rounded-md-2">
    <div class="swiper-wrapper bg-white rounded-md-2">

      @if (auth()->check() && auth()->user()->hasCompleteStoreProfile())
      <div class="swiper-slide">
        <div class="w-100 mt-0">
          <div class="card border-0 my-0 mb-3">
            <create-story-carousel-button :store="{{json_encode(auth()->user()->store)}}">
            </create-story-carousel-button>
          </div>
        </div>
      </div>
      @endif

      @if (!empty($stores))

      @foreach ($stores as $store)
      <div class="swiper-slide">
        <div class="w-100 mt-0">
          <div class="card border-0 my-0">
            <stories-by-store-card :store="{{json_encode($store)}}"></stories-by-store-card>
          </div>
        </div>
      </div>
      @endforeach
      @endif



    </div>
  </div>
  {{-- <!-- Add Arrows --> --}}
  <div class="swiper-button-next swiper-btn-stories-next"></div>
  <div class="swiper-button-prev swiper-btn-stories-prev"></div>
</div>


<!-- CREATE STORY MODAL WITH CAROUSEL -->
<stories-modal ref="StoriesModal" :stores="{{json_encode($stores->toArray())}}"></stories-modal>

