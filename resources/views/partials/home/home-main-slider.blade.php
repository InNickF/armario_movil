@if ($home_top_slider)
<div class="row">
  <div class="container border-header mb-5 mt-md-5 mt-2 p-3">
    <div id="homeSlider" class="swiper-slider swiper-container rounded-md box-shadow-dark home-slider">
      <div class="swiper-wrapper">
        @foreach ($home_top_slider->slides as $slide)
        <div style="background-image:url({{ $slide->image }});" class="swiper-slide bg-cover bg-center bg-no-repeat">
          <div class="w-100 position-absolute bottom-0">
            <div class="text-center z-999 w-100 pt-4">
              <div class="d-flex align-items-end w-75 h-100 mx-auto pb-2 pb-md-4">
                <div class="w-100 mx-auto">
                  
                  @if ($slide->body)
                  <div
                    class="rounded p-2 mb-2 bg-{{$slide->button_theme == 'light' ? 'primary-opaque' : 'white-opaque'}}">
                    <p class="mb-0 bg-opaque text-sm text-{{$slide->button_theme == 'light' ? 'white' : 'primary'}}">
                      {{$slide->body}}
                    </p>
                  </div>
                  @endif

                  <a href="{{ $slide->url }}" class="btn btn-{{$slide->button_theme == 'light' ? 'light' : 'primary'}}">
                    {{ $slide->button_text }}
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach

      </div>

      {{-- <div class="swiper-pagination"></div> --}}
      <!-- Add Arrows -->
      <div class="swiper-button-next swiper-mob-arrow-next"></div>
      <div class="swiper-button-prev swiper-mob-arrow-prev"></div>
    </div>
  </div>
</div>
@endif
