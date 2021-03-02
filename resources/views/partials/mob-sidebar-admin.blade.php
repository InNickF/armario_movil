      <!-- Dropdown - Search -->
      <div class="m-0 p-0 d-block d-lg-none">
      <div class="modal fade modal-bg modal-bg-2 p-4" id="mobSidebarAdmin" role="dialog" aria-labelledby="mobSidebar" aria-hidden="true" data-backdrop="false">
      <button type="button" class="close text-light close-modal-img-fixed" data-dismiss="modal" aria-label="Close">
      <img src="{{ asset('images/n-close-modal-btn.png') }}" class="img-fluid"
          alt="">
                          </button>
          <div class="modal-lg modal-dialog h-100" style="transition: all 0s!important" role="document">
              <div class="modal-content h-100">
              
                  <div class="modal-body">
                      <div class="modal-header">
                          <ul class="position-fixed navbar-nav max-height-100-vh sidebar accordion sidebar-container bg-dark rounded pb-5 o-visible pr-1 d-flex" id="accordionSidebar">

                            <ul class="position-fixed navbar-nav max-height-100-vh sidebar accordion sidebar-container bg-dark rounded pb-5 o-visible pr-1 d-lg-flex" id="accordionSidebar">

                              <!-- Sidebar - Brand -->
                              <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
                                <div class="sidebar-brand-text mx-3 text-white">{{setting('title','Armario Móvil')}}</div>
                              </a>
                            
                            
                              @include('partials.sidebar.sidebar-user-area', ['tagline' => 'Perfil de administrador'])
                            
                              <!-- Divider -->
                              <hr class="sidebar-divider">
                            
                              <!-- Nav Item - Tables -->
                              <div id="cont-menu-sidebar">
                                <li class="nav-item active">
                                  <a class="nav-link" href="{{ url('/admin/settings') }}">
                                    <i class="fas fa-fw fa-cog"></i>
                                    <span>Ajustes generales</span></a>
                                </li>
                            
                            
                                <!-- Nav Item - Tables -->
                                <li class="nav-item active">
                                  <a class="nav-link" href="{{ url('/admin/users') }}">
                                    <i class="fas fa-fw fa-user"></i>
                                    <span>Usuarios</span></a>
                                </li>
                            
                            
                                <!-- Nav Item - Pages Collapse Menu -->
                                <li class="nav-item">
                                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#store" aria-expanded="true"
                                    aria-controls="store">
                                    <img src="{{ asset('images/icons/sidebar/bag-icon.svg') }}" class="img-sidebar image-svg icon-light" alt="">
                                    <span>Shop</span>
                                  </a>
                            
                                  <div id="store" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                    <div class="bg-transparent py-2 collapse-inner">
                                      <div class="ml-4 mb-3">
                                        <a class="nav-item" href="{{ url('/admin/stores') }}">
                                          <img src="{{ asset('images/icons/sidebar/bag-icon.svg') }}" class="img-sidebar image-svg icon-light"
                                            alt="">
                                          <span>Tiendas</span>
                                        </a>
                                      </div>
                            
                                      <div class="ml-4 mb-3">
                                        <a class="nav-item" href="{{ url('/admin/products') }}">
                                          <img src="{{ asset('images/icons/sidebar/bag-icon.svg') }}" class="img-sidebar image-svg icon-light"
                                            alt="">
                                          <span>Productos</span>
                                        </a>
                                      </div>
                            
                                      <div class="ml-4 mb-3">
                                        <a class="nav-item" href="{{ url('/admin/stories') }}">
                                          <img src="{{ asset('images/icons/sidebar/bag-icon.svg') }}" class="img-sidebar image-svg icon-light"
                                            alt="">
                                          <span>Historias</span>
                                        </a>
                                      </div>
                            
                                      <div class="ml-4 mb-3">
                                        <a class="nav-item" href="{{ url('/admin/orders') }}">
                                          <img src="{{ asset('images/icons/sidebar/bag-icon.svg') }}" class="img-sidebar image-svg icon-light"
                                            alt="">
                                          <span>Pedidos</span>
                                        </a>
                                      </div>
                            
                            
                                      <div class="ml-4 mb-3">
                                        <a class="nav-item" href="{{ url('/admin/categories') }}">
                                          <img src="{{ asset('images/icons/sidebar/bag-icon.svg') }}" class="img-sidebar image-svg icon-light"
                                            alt="">
                                          <span>Categorías de productos</span>
                                        </a>
                                      </div>
                            
                            
                                      {{-- <div class="ml-4 mb-3">
                                      <a class="nav-item" href="{{ url('/admin/outfits') }}">
                                      <img src="{{ asset('images/icons/sidebar/bag-icon.svg') }}" class="img-sidebar image-svg icon-light" alt="">
                                      <span>Outfits</span>
                                      </a>
                                    </div> --}}
                            
                            
                            
                                    <div class="ml-4 mb-3">
                                      <a class="nav-item" href="{{ url('/admin/coupons') }}">
                                        <img src="{{ asset('images/icons/sidebar/bag-icon.svg') }}" class="img-sidebar image-svg icon-light" alt="">
                                        <span>Cupones</span>
                                      </a>
                                    </div>
                            
                            
                            
                            
                            
                                    <div class="ml-4 mb-3">
                                      <a class="nav-item" href="{{ url('/admin/transactions') }}">
                                        <img src="{{ asset('images/icons/sidebar/usd-icon.svg') }}" class="img-sidebar image-svg icon-light" alt="">
                                        <span>Transacciones</span>
                                      </a>
                                    </div>
                            
                            
                                    <div class="ml-4 mb-3">
                                      <a class="nav-item" href="{{ url('/admin/questions') }}">
                                        <i class="fa fa-question" aria-hidden="true"></i>
                                        <span>Preguntas & Respuestas</span>
                                      </a>
                                    </div>
                            
                            
                                    <div class="ml-4 mb-3">
                                      <a class="nav-item" href="{{ url('/admin/form_requests') }}">
                                        <i class="fa fa-list-ol" aria-hidden="true"></i>
                                        <span>Suscripciones por Email / Contactos</span></a>
                                    </div>
                            
                            
                            
                                  </div>
                              </div>
                              </li>
                            
                            
                            
                              <!-- Nav Item - Pages Collapse Menu -->
                              <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cms" aria-expanded="true"
                                  aria-controls="cms">
                                  <i class="fa fa-list-ol" aria-hidden="true"></i>
                                  <span>Contenidos</span>
                                </a>
                            
                                <div id="cms" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                  <div class="bg-transparent py-2 collapse-inner">
                            
                                    <div class="ml-4 mb-3">
                                      <a class="nav-item" href="{{ url('/admin/faqs') }}">
                                        <i class="fa fa-list-ol" aria-hidden="true"></i>
                                        <span>Preguntas frecuentes</span>
                                      </a>
                                    </div>
                            
                                    <div class="ml-4 mb-3">
                                      <a class="nav-item" href="{{ url('/admin/faqCategories') }}">
                                        <i class="fa fa-list-ol" aria-hidden="true"></i>
                                        <span>Categorías de preguntas frecuentes</span>
                                      </a>
                                    </div>
                            
                            
                                    <div class="ml-4 mb-3">
                                      <a class="nav-item" href="{{ url('/admin/articles') }}">
                                        <i class="fa fa-list-ol" aria-hidden="true"></i>
                                        <span>Asesorías</span>
                                      </a>
                                    </div>
                            
                                    <div class="ml-4 mb-3">
                                      <a class="nav-item" href="{{ url('/admin/articleCategories') }}">
                                        <i class="fa fa-list-ol" aria-hidden="true"></i>
                                        <span>Categorías de asesorías</span>
                                      </a>
                                    </div>
                            
                            
                                    <div class="ml-4 mb-3">
                                      <a class="nav-item" href="{{ url('/admin/posts') }}">
                                        <i class="fa fa-list-ol" aria-hidden="true"></i>
                                        <span>Entradas de blog</span>
                                      </a>
                                    </div>
                            
                                    <div class="ml-4 mb-3">
                                      <a class="nav-item" href="{{ url('/admin/postCategories') }}">
                                        <i class="fa fa-list-ol" aria-hidden="true"></i>
                                        <span>Categorías de blog</span>
                                      </a>
                                    </div>
                            
                            
                                    <div class="ml-4 mb-3">
                                      <a class="nav-item" href="{{ url('/admin/testimonials') }}">
                                        <i class="fa fa-list-ol" aria-hidden="true"></i>
                                        <span>Testimonios</span>
                                      </a>
                                    </div>
                            
                            
                                    <div class="ml-4 mb-3">
                                      <a class="nav-item" href="{{ url('/admin/sliders') }}">
                                        <i class="fa fa-list-ol" aria-hidden="true"></i>
                                        <span>Sliders y Banners</span>
                                      </a>
                                    </div>
                            
                                  </div>
                                </div>
                              </li>
                            
                            
                              <!-- Nav Item - Tables -->
                              {{-- <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/admin/push_notifications') }}">
                              <i class="fa fa-list-ol" aria-hidden="true"></i>
                              <span>Notificaciones Push</span></a>
                              </li> --}}
                            
                            
                            
                              <!-- Nav Item - Tables -->
                              {{-- <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/admin/reviews') }}">
                              <i class="fa fa-list-ol" aria-hidden="true"></i>
                              <span>Reseñas</span></a>
                              </li> --}}
                            
                            
                              <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/admin/logs') }}">
                                  <i class="fa fa-list-ol" aria-hidden="true"></i>
                                  <span>Registro de eventos</span></a>
                              </li>
                            
                              </div>
                            
                              <!-- Divider -->
                              <hr class="sidebar-divider d-none d-md-block">
                            
                              <!-- Sidebar Toggler (Sidebar) -->
                              <div class="text-center d-none d-md-block">
                                <button class="rounded-circle border-0" id="sidebarToggle"></button>
                              </div>
                            
                            </ul>
                            <!-- End of Sidebar -->
                            


<!-- Divider -->

{{--
  <!-- Heading -->
  <div class="sidebar-heading">
      VENDER
  </div>

  <!-- Nav Item - Tables -->
  <li class="nav-item px-4">
      <a class="nav-item" href="{{ url('/profile') }}">
<i class="fas fa-fw fa-user"></i>
<span>Perfil comercial</span></a>
</li>



<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="w-100 nav-link nav-link-non-collapsed__style collapsed" href="#" data-toggle="collapse" data-target="#store-config" aria-expanded="true"
    aria-controls="store-config">
    <i class="fas fa-fw fa-cog"></i>
    <span class="">Configuración</span>
  </a>
  <div id="store-config" class="collapse style-subitem-on-collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Opciones:</h6>
      <a class="collapse-item" href="{{ url('/store/auction') }}">Subasta</a>
      <a class="collapse-item" href="{{ url('/store/notifications') }}">Notificaciones</a>
      <a class="collapse-item" href="{{ url('/store/bonuses') }}">Bonificaciones</a>
    </div>
  </div>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
  <a class="w-100 nav-link nav-link-non-collapsed__style collapsed" href="#" data-toggle="collapse" data-target="#transactions" aria-expanded="true"
    aria-controls="transactions">
    <i class="fas fa-fw fa-credit-card"></i>
    <span class="">Transacciones</span>
  </a>
  <div id="transactions" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Opciones:</h6>
      <a class="collapse-item" href="{{ url('/payment-methods') }}">Cuenta de pagos</a>
    </div>
  </div>
</li> --}}


{{--
  <!-- Divider -->
  <hr class="sidebar-divider"> --}}

{{--
  <!-- Heading -->
  <div class="sidebar-heading">
      ASISTENCIA
  </div> --}}

<!-- Nav Item - Pages Collapse Menu -->
{{-- <li class="nav-item">
  <a class="nav-link" href="{{ url('/preguntas-frecuentes') }}">
    <img src="{{ asset('images/icons/sidebar/info-icon.svg') }}" class="img-sidebar image-svg icon-light" alt="">
    <span>Asistencia</span>
  </a>
</li>


<li class="nav-item">
  <a class="w-100 nav-link" href="{{ url('/logout') }}" data-toggle="modal" data-target="#logoutModal">
    <img src="{{ asset('images/icons/sidebar/exit-icon.svg') }}" class=" img-sidebar image-svg icon-light" alt="">
    <span>Cerrar sesión</span></a>
</li> --}}
</div>
<!-- Nav Item - Utilities Collapse Menu -->
{{-- <li class="nav-item">
      <a class="nav-link nav-link-non-collapsed__style collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true"
          aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Utilities</span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Custom Utilities:</h6>
              <a class="collapse-item" href="utilities-color.html">Colors</a>
              <a class="collapse-item" href="utilities-border.html">Borders</a>
              <a class="collapse-item" href="utilities-animation.html">Animations</a>
              <a class="collapse-item" href="utilities-other.html">Other</a>
          </div>
      </div>
  </li> --}}

<!-- Divider -->
{{--
  <hr class="sidebar-divider"> --}}

<!-- Heading -->
{{-- <div class="sidebar-heading">
      Addons
  </div> --}}

<!-- Nav Item - Pages Collapse Menu -->
{{-- <li class="nav-item">
      <a class="nav-link nav-link-non-collapsed__style collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
          aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
      </a>
      <div id="collapsePages" class="collapse style-subitem-on-collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Login Screens:</h6>
              <a class="collapse-item" href="login.html">Login</a>
              <a class="collapse-item" href="register.html">Register</a>
              <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
              <div class="collapse-divider"></div>
              <h6 class="collapse-header">Other Pages:</h6>
              <a class="collapse-item" href="404.html">404 Page</a>
              <a class="collapse-item" href="blank.html">Blank Page</a>
          </div>
      </div>
  </li> --}}

</ul>


                      </div>
                      
                  </div>

              </div>
          </div>
      </div>
      <!-- Dropdown - Search -->

      