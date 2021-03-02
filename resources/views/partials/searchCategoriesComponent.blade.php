      <!-- Dropdown - Search -->
      <div class="modal fade modal-bg" id="globalCategorySearch" role="dialog" aria-labelledby="globalCategorySearch"
        aria-hidden="true">
        <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content h-100">
            <div class="modal-body">
              <div class="modal-header">
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                  <img src="{{ asset('images/n-close-modal-btn.png') }}" class="img-fluid" alt="">
                </button>
              </div>
              <h5 class="modal-title h1 text-center px-3 px-sm-0" id="globalCategorySearch">Categorías</h5>
              <p class="text-center text-light px-3 px-sm-0">Aquí puedes ver todas las categorías que hay en Armario
                Móvil</p>
              <div class="row">
                <ul class="nav d-flex flex-wrap justify-content-center align-content-center">


                  @php
                  	$categories = \App\Models\Category::parents()->get();
                  @endphp
                  @foreach ($categories as $cat)
                  <li class="nav-item mt-2">
                      <a href="{{$cat->url}}"
                        class="btn btn-sm search-component__item mx-2 my-1 p-2">
                        <img src="{{ $cat['icon_image'] }}" alt="" class="image-svg img-fluid search-ategory__icon">
                        <b class="mb-2 d-block text-light">{{ $cat['name'] }}</b>
                      </a>
                  </li>


                  @endforeach
                </ul>
              </div>
            </div>
            <div class="modal-footer border-0">
              <button type="button" class="m-auto text-light text-secondary btn" data-dismiss="modal">Cerrar
                buscardor</button>
            </div>
          </div>

        </div>
      </div>
      </div>
      <!-- Dropdown - Search -->
