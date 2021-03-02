<div class="d-none d-md-flex flex-wrap justify-content-center m-3 ">
  <ul class="nav justify-content-center align-content-center">
    @foreach ($categories as $cat)
  <li class="nav-item mt-2">
      <a href="{{ $cat['url'] }}" class="btn btn-sm btn-outline-secondary text-light header-btn header--border__nick mx-1 {{$config['categoryId'] == $cat['id'] || ($active && $active->parent_id == $cat['id'])  ? 'btn-primary btn-header-active' : ''}}"><b>{{ $cat['name'] }}</b></a>
    </li>
    @endforeach
    
  </ul>
</div>

<div class="d-flex d-sm-flex d-md-none flex-wrap justify-content-center m-3">
<a href="#" data-toggle="modal" data-target="#globalCategorySearch" class="btn btn-sm btn-outline-secondary mx-1 px-4 text-light header-btn header--border__nick"><b>Ver categorías de productos</b></a>
</div>


@if ($subcategories && $subcategories->count())
<div class="container my-4">
  <div class="row position-relative">

    <div id="subcategory-slider" class="swiper-slider-9 swiper-container my-2 swiper-navigation-offset">
      <div class="swiper-wrapper">

        @foreach ($subcategories as $cat)
        <div class="swiper-slide">
          <a href="{{$cat->url}}" class="text-center text-white text-sm subcategory-button">
          <div class="category-desactive {{$active->id == $cat->id ? 'category-active' : ''}}">
              <img src="{{ $cat->icon_image }}" class="icon-categories-menu image-svg" alt="">
              <p class="mt-2">
                {{$cat->name}}
              </p>
            </div>
          </a>
        </div>
        @endforeach

      </div>
      <div class="swiper-pagination"></div>
      <!-- Add Arrows -->
    </div>
    <div class="swiper-button-next swiper-btn-outside-next swiper-btn-outside-subcategories-next swiper-mob-arrow-next"></div>
      <div class="swiper-button-prev swiper-btn-outside-prev swiper-btn-outside-subcategories-prev swiper-mob-arrow-prev"></div>
  </div>
</div>

@endif
