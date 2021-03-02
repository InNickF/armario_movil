<!-- Sidebar -->


<div class="sidebar-false fake-gray d-none d-lg-block"></div>
<ul class="position-fixed navbar-nav max-height-100-vh sidebar accordion sidebar-container bg-gradient rounded pb-5 o-visible pr-1 d-none d-lg-flex" id="accordionSidebar">

  <!-- Sidebar - Brand -->
    <div class="bg-cover">
      <a class="sidebar-brand d-flex align-items-center justify-content-center mt-3" href="{{ url('/') }}">
        <div class="sidebar-brand-text mx-3">

          <div class="logo-no-collapse">
              <img src="{{setting('logo_image', asset('images/icons/logo-armario-movil.png'))}}" class="img-fluid image-svg sidebar-main-logo" alt="">

          </div>
            <img src="{{ asset('images/icons/iso-armario-movil.png') }}" class="img-fluid logo-collapse d-none" alt="">
        </div>
      </a>

      <a class="mx-auto" href="{{ url('/account/profile') }}">
        @include('partials.sidebar.sidebar-user-area', ['tagline' => 'Perfil de usuario'])
      </a>

    </div>

    <!-- Divider -->


    <!-- Nav Item - Tables -->
    <div id="cont-menu-sidebar" class="p-0">
      <li class="nav-item">
        <a class="icon-toggle__scale nav-link" href="{{ url('/account/profile') }}">
          <img src="{{ asset('images/icons/sidebar/person-icon.svg') }}" class="img-sidebar image-svg icon-light"
            alt="">
          <span class="nav-text-span-collased__d-none">Mi cuenta</span></a>
      </li>

      <!-- Nav Item - Tables -->

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="icon-toggle__scale nav-link nav-link-non-collapsed__style nav-link-non-collapsed__style collapsed" href="#" data-toggle="collapse" data-target="#store" aria-expanded="true"
          aria-controls="store">
          <img src="{{ asset('images/icons/sidebar/bag-icon.svg') }}" class="img-sidebar image-svg icon-light" alt="">
          <span class="nav-text-span-collased__d-none">Armario de compras</span>
        </a>

        <div id="store" class="collapse style-subitem-on-collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-transparent py-2 collapse-inner">

            <div class="ml-4 mb-3">
              <a class="icon-toggle__scale nav-item" href="{{ url('/account/orders') }}">
                <img src="{{ asset('images/icons/sidebar/usd-icon.svg') }}" class="img-sidebar image-svg icon-light"
                  alt="">
                <span class="nav-text-span-collased__d-none">Mis compras</span>
              </a>
            </div>

            <div class="ml-4 mb-3">
                <a class="icon-toggle__scale nav-item" href="{{ url('/account/wishlist') }}">
                  <img src="{{ asset('images/icons/sidebar/heart-icon.svg') }}" class="img-sidebar image-svg icon-light p-1"
                    alt="">
                    {{-- <i class="far fa-heart text-white"></i> --}}
                  <span class="nav-text-span-collased__d-none">Mis favoritos</span>
                </a>
              </div>

            <div class="ml-4 mb-3">
              <a class="icon-toggle__scale nav-item" href="{{ url('/account/questions') }}">
                <img src="{{ asset('images/icons/sidebar/question-icon.svg') }}"
                  class="img-sidebar image-svg icon-light" alt="">
                <span class="nav-text-span-collased__d-none">Mis preguntas</span>
              </a>
            </div>

            <div class="ml-4 pl-2 mb-0">
                <a class="icon-toggle__scale nav-item" href="{{ url('/account/followed_categories') }}">
                  <i class="fa fa-cog mr-2"></i>
                  <span class="nav-text-span-collased__d-none">Preferencias</span>
                </a>
              </div>

          </div>
        </div>
      </li>



      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="icon-toggle__scale nav-link nav-link-non-collapsed__style collapsed" href="#" data-toggle="collapse" data-target="#store-store" aria-expanded="true"
          aria-controls="store-store">
          <img src="{{ asset('images/icons/sidebar/shirt-icon.svg') }}" class="img-sidebar image-svg icon-light" alt="">
          <span class="nav-text-span-collased__d-none">Armario de ventas</span>
        </a>

        <div id="store-store" class="collapse style-subitem-on-collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-transparent py-2 collapse-inner">
            <div class="ml-4 mb-3">
              <a class="icon-toggle__scale nav-item" href="{{ url('/account/products') }}">
                <img src="{{ asset('images/icons/sidebar/shirt-icon-2.svg') }}" class="img-sidebar image-svg icon-light"
                  alt="">
                <span class="nav-text-span-collased__d-none">Mis productos</span>
              </a>
            </div>

            <div class="ml-4 mb-3">
                <a class="icon-toggle__scale nav-item" href="{{ url('/account/outfits') }}">
                  <img src="{{ asset('images/icons/sidebar/outfit-icon.svg') }}" class="img-sidebar image-svg icon-light"
                    alt="">
                  <span class="nav-text-span-collased__d-none">Mis outfits</span>
                </a>
              </div>


              <div class="ml-4 mb-3">
                  <a class="icon-toggle__scale nav-item" href="{{ url('/account/stories') }}">
                    <img src="{{ asset('images/icons/sidebar/24-icon.svg') }}" class="img-sidebar image-svg icon-light"
                      alt="">
                    <span class="nav-text-span-collased__d-none">Mis historias</span>
                  </a>
                </div>

            <div class="ml-4 mb-3">
              <a class="icon-toggle__scale nav-item" href="{{ url('account/store/orders') }}">
                <img src="{{ asset('images/icons/sidebar/usd-icon.svg') }}" class="img-sidebar image-svg icon-light"
                  alt="">
                <span class="nav-text-span-collased__d-none">Mis ventas</span>
              </a>
            </div>

            {{-- <div class="ml-4 mb-3">
            <a class="icon-toggle__scale nav-item" href="{{ url('/account/ads') }}">
            <img src="{{ asset('images/icons/sidebar/flag-icon.svg') }}" class="img-sidebar image-svg icon-light"
              alt="">
            <span class="nav-text-span-collased__d-none">Anuncios</span>
            </a>
          </div> --}}


          <div class="ml-4 mb-3">
            <a class="icon-toggle__scale nav-item" href="{{ url('/account/storeReviews') }}">
              <img src="{{ asset('images/icons/sidebar/star-icon.svg') }}" class="img-sidebar image-svg icon-light"
                alt="">
              <span class="nav-text-span-collased__d-none">Mis Calificaciones</span>
            </a>
          </div>

          {{-- <div class="ml-4 mb-3">
            <a class="icon-toggle__scale nav-item" href="{{ url('/account/reports') }}">
          <img src="{{ asset('images/icons/sidebar/screen-icon.svg') }}" class="img-sidebar image-svg icon-light"
            alt="">
          <span class="nav-text-span-collased__d-none">Mis reportes</span>
          </a>
        </div> --}}

        <div class="ml-4 mb-3">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/plans') }}">
            <img src="{{ asset('images/icons/sidebar/diamond-icon.svg') }}" class="img-sidebar image-svg icon-light"
              alt="">
            <span class="nav-text-span-collased__d-none">Mi suscripción</span>
          </a>
        </div>

        <div class="ml-4 mb-3">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/answers') }}">
            <img src="{{ asset('images/icons/sidebar/question-icon.svg') }}" class="img-sidebar image-svg icon-light"
              alt="">
            <span class="nav-text-span-collased__d-none">Preguntas recibidas</span>
          </a>
        </div>


        <div class="ml-4 pl-1">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/store/gallery') }}">
            <i class="fa fa-image fix"></i>
            <span class="pl-2 nav-text-span-collased__d-none">Galería de tienda</span>
          </a>
        </div>

    </div>
  </div>
  </li>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="icon-toggle__scale nav-link nav-link-non-collapsed__style collapsed" href="#" data-toggle="collapse" data-target="#reports" aria-expanded="true"
      aria-controls="reports">
      <img src="{{ asset('images/icons/sidebar/pie-icon.svg') }}" class="img-sidebar image-svg icon-light" alt="">
      <span class="nav-text-span-collased__d-none">Mis reportes</span>
    </a>
    <div id="reports" class="collapse style-subitem-on-collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-transparent py-2 collapse-inner rounded">

        <div class="mb-4 ml-4">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/dashboards/sell_records') }}">
            <img src="{{ asset('images/icons/sidebar/clock-icon.svg') }}" class="img-sidebar image-svg icon-light"
              alt="">
            <span class="nav-text-span-collased__d-none">Historial de ventas</span>
          </a>
        </div>

        <div class="mb-4 ml-4">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/dashboards/business_profile') }}">
            <img src="{{ asset('images/icons/sidebar/shopping-cart-icon.svg') }}"
              class="img-sidebar image-svg icon-light" alt="">
            <span class="nav-text-span-collased__d-none">Perfil comercial</span>
          </a>
        </div>

        <div class="mb-4 ml-4 position-relative pro-analytic">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/dashboards/interactions') }}">
            <img src="{{ asset('images/icons/sidebar/pointer-icon.svg') }}" class="img-sidebar image-svg icon-light"
              alt="">
            <span class="nav-text-span-collased__d-none">Interacciones</span>
          </a>
        </div>

        <div class="mb-4 ml-4 position-relative pro-analytic">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/dashboards/products') }}">
            <img src="{{ asset('images/icons/sidebar/box-icon.svg') }}" class="img-sidebar image-svg icon-light" alt="">
            <span class="nav-text-span-collased__d-none">Categorías de productos</span>
          </a>
        </div>

        <div class="mb-4 ml-4 position-relative pro-analytic">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/dashboards/cities') }}">
            <img src="{{ asset('images/icons/sidebar/flag-2-icon.svg') }}" class="img-sidebar image-svg icon-light"
              alt="">
            <span class="nav-text-span-collased__d-none">Ciudades</span>
          </a>
        </div>

        <div class="ml-4 position-relative pro-analytic">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/dashboards/funnel') }}">
            <img src="{{ asset('images/icons/sidebar/funnel-icon.svg') }}" class="img-sidebar image-svg icon-light"
              alt="">
            <span class="nav-text-span-collased__d-none">Embudo</span>
          </a>
        </div>

      </div>
    </div>
  </li>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="icon-toggle__scale nav-link nav-link-non-collapsed__style collapsed" href="#" data-toggle="collapse" data-target="#assesment" aria-expanded="true"
      aria-controls="assesment">
      <img src="{{ asset('images/icons/sidebar/bars-icon.svg') }}" class="img-sidebar image-svg icon-light" alt="">
      <span class="nav-text-span-collased__d-none">Asesorías</span>
    </a>
    <div id="assesment" class="collapse style-subitem-on-collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-transparent py-2 collapse-inner rounded">

        <div class="mb-4 ml-4">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/articles/category/1') }}">
            <img src="{{ asset('images/icons/sidebar/shirt-fold-icon.svg') }}" class="img-sidebar image-svg icon-light"
              alt="">
            <span class="nav-text-span-collased__d-none">Moda</span>
          </a>
        </div>

        <div class="mb-4 ml-4">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/articles/category/2') }}">
            <img src="{{ asset('images/icons/sidebar/camera-icon.svg') }}" class="img-sidebar image-svg icon-light"
              alt="">
            <span class="nav-text-span-collased__d-none">Fotografías</span>
          </a>
        </div>

        <div class="mb-4 ml-4">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/articles/category/3') }}">
            <img src="{{ asset('images/icons/sidebar/marketing-icon.svg') }}" class="img-sidebar image-svg icon-light"
              alt="">
            <span class="nav-text-span-collased__d-none">Marketing Digital</span>
          </a>
        </div>

        <div class="ml-4">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/articles/category/4') }}">
            <img src="{{ asset('images/icons/sidebar/screen-money-icon.svg') }}"
              class="img-sidebar image-svg icon-light" alt="">
            <span class="nav-text-span-collased__d-none">Negocios digitales</span>
          </a>
        </div>

      </div>
    </div>
  </li>


  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="icon-toggle__scale nav-link nav-link-non-collapsed__style collapsed" href="#" data-toggle="collapse" data-target="#config" aria-expanded="true"
      aria-controls="config">
      <img src="{{ asset('images/icons/sidebar/engine-icon.svg') }}" class="img-sidebar image-svg icon-light" alt="">
      <span class="nav-text-span-collased__d-none">Ajustes</span>
    </a>
    <div id="config" class="collapse style-subitem-on-collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-transparent py-2 collapse-inner rounded">


        <div class="mb-4 ml-4">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/password') }}">
            <img src="{{ asset('images/icons/sidebar/lock-icon.svg') }}" class="img-sidebar image-svg icon-light"
              alt="">
            <span class="nav-text-span-collased__d-none">Seguridad</span>
          </a>
        </div>

        <div class="mb-4 ml-4">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/addresses') }}">
            <img src="{{ asset('images/icons/sidebar/pin-icon.svg') }}" class="img-sidebar image-svg icon-light" alt="">
            <span class="nav-text-span-collased__d-none">Localidades</span>
          </a>
        </div>

        <div class="mb-4 ml-4">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/billing') }}">
            <img src="{{ asset('images/icons/sidebar/paper-icon-2.svg') }}" class="img-sidebar image-svg icon-light"
              alt="">
            <span class="nav-text-span-collased__d-none">Facturación</span>
          </a>
        </div>

        <div class="mb-4 ml-4">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/payment') }}">
            <img src="{{ asset('images/icons/sidebar/coin-hand-icon.svg') }}" class="img-sidebar image-svg icon-light"
              alt="">
            <span class="nav-text-span-collased__d-none">Pagos y cobros</span>
          </a>
        </div>

        <div class="ml-4">
          <a class="icon-toggle__scale nav-item" href="{{ url('/account/notifications') }}">
            <img src="{{ asset('images/icons/sidebar/bell-icon.svg') }}" class="img-sidebar image-svg icon-light"
              alt="">
            <span class="nav-text-span-collased__d-none">Notificaciones</span>
          </a>
        </div>

      </div>
    </div>
  </li>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="icon-toggle__scale nav-link" href="{{ url('/account/transactions') }}">
      <img src="{{ asset('images/icons/sidebar/paper-icon.svg') }}" class="img-sidebar image-svg icon-light" alt="">
      <span class="nav-text-span-collased__d-none">Mis transacciones</span>
    </a>
  </li>

   <!-- Nav Item - Pages Collapse Menu -->
   <li class="nav-item">
    <a class="icon-toggle__scale nav-link" href="{{ url('/preguntas-frecuentes') }}" target="_blank">
      <img src="{{ asset('images/icons/sidebar/info-icon.svg') }}" class="img-sidebar image-svg icon-light" alt="">
      <span class="nav-text-span-collased__d-none">Asistencia</span>
    </a>
  </li>


  <li class="nav-item">
    <a class="icon-toggle__scale nav-link" href="{{ url('/logout') }}" data-toggle="modal" data-target="#logoutModal">
      <img src="{{ asset('images/icons/sidebar/exit-icon.svg') }}" class=" img-sidebar image-svg icon-light" alt="">
      <span class="nav-text-span-collased__d-none">Cerrar sesión</span></a>
  </li>


  <div class="mb-3"></div>


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
    <a class="icon-toggle__scale nav-link nav-link-non-collapsed__style collapsed" href="#" data-toggle="collapse" data-target="#store-config" aria-expanded="true"
      aria-controls="store-config">
      <i class="fas fa-fw fa-cog"></i>
      <span class="nav-text-span-collased__d-none">Configuración</span>
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
    <a class="icon-toggle__scale nav-link nav-link-non-collapsed__style collapsed" href="#" data-toggle="collapse" data-target="#transactions" aria-expanded="true"
      aria-controls="transactions">
      <i class="fas fa-fw fa-credit-card"></i>
      <span class="nav-text-span-collased__d-none">Transacciones</span>
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
    <a class="icon-toggle__scale nav-link" href="{{ url('/logout') }}" data-toggle="modal" data-target="#logoutModal">
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


  <!-- Sidebar Toggler (Sidebar) -->
    <button class="rounded-circle border-0" id="sidebarToggle"></button>

</ul>


