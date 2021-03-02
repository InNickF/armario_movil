<!-- Sidebar -->
<div class="sidebar-false fake-gray d-none d-lg-block"></div>

<ul class="position-fixed navbar-nav max-height-100-vh sidebar accordion sidebar-container bg-dark rounded pb-5 o-visible pr-1 d-none d-lg-flex" id="accordionSidebar">

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
