      <!-- Dropdown - Search -->
      <div class="modal fade modal-bg" id="globalSearch" role="dialog" aria-labelledby="globalSearch" aria-hidden="true">
          <div class="modal-lg modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content h-100">
                  <div class="modal-body">
                      <div class="modal-header">
                          <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                          <img src="{{ asset('images/n-close-modal-btn.png') }}" class="img-fluid"
          alt="">
                          </button>
                      </div>
                      <h5 class="modal-title h1 text-center px-3 px-sm-0" id="globalSearch">Búsqueda</h5>
                      <p class="text-center text-light px-3 px-sm-0">Introduce aquí palabras claves o el nombre del producto que deseas.</p>
                      <div class="row px-4 px-sm-0" id="searchForm">
                          {!! Form::open(['route' => 'buscar', 'method' => 'get']) !!}
                          <input name="q" autofocus type="text" class="form-control text-light bg-transparent border-1 border-light small form-control-white" placeholder="Escribe aquí tu búsqueda..." aria-label="Buscar">
                          <button class="btn d-block bg-white text-dark w-100 mt-3" type="submit">
                              Buscar
                          </button>
                      </div>
                      {!! Form::close() !!}
                      <div class="modal-footer border-0">
                          <button type="button" class="m-auto text-light text-secondary btn" data-dismiss="modal" >Cerrar buscardor</button>
                      </div>
                  </div>

              </div>
          </div>
      </div>
      <!-- Dropdown - Search -->