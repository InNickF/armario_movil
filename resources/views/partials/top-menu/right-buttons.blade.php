<nav class="justify-content-end d-none d-md-flex">


<!-- Sidebar Toggle (Topbar) -->

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto my-0 py-0 ">

  <!-- Nav Item - Search Dropdown (Visible Only XS) -->
  <div class="d-flex align-items-center ">
    <li class="nav-item dropdown no-arrow mx-2">
      <a class="nav-link" href="#" class="btn btn-primary" data-toggle="modal" data-target="#globalSearch" title="Buscar...">
        <img src="{{ setting('search_icon', asset('images/icons/top-menu/search-icon.svg')) }}" class="small-icon-size">
      </a>
    </li>

    <li class="nav-item no-arrow mx-2">
      <a class="nav-link" href="{{setting('landing_url')}}" title="Promociones">
        <img src="{{ setting('landing_icon', asset('images/icons/top-menu/medal-icon.svg')) }}" class="small-icon-size">
      </a>
    </li>

     {{-- Wishlist --}}
     <li class="nav-item no-arrow mx-2">
     <a class="nav-link" href="{{url('/account/wishlist')}}" title="Mis favoritos">
      <img class="small-icon-size" src="{{ asset('images/icons/top-menu/heart-icon.svg') }}">
     </a>
     </li>

    <li class="nav-item dropdown no-arrow mx-2">
      <cart-icon v-on:get-cart="getCart" icon="{{ setting('cart_icon', asset('images/icons/top-menu/bag-cart-icon.svg')) }}"></cart-icon>
    </li>


    @if (auth()->check())
    <li class="nav-item dropdown no-arrow mx-2">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false" title="Mi perfil">

        {{-- <img class="small-icon-size" src="{{ asset('images/icons/top-menu/profile-icon.svg') }}"> --}}
    <div class="avatar-sm rounded-circle bg-cover bg-center" style="background-image:url('{{ auth()->user()->avatar_image }}')"></div>
      {{-- <img class="small-icon-size rounded-circle" src="{{ auth()->user()->avatar_image }}"> --}}
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow p-0 opacity-9" aria-labelledby="userDropdown">
        <a class="dropdown-item py-2" href="{!! url('/account/profile') !!}" title="Área personal">
          <img class="fa-fw mr-2"  src="{{ asset('images/icons/profile-menu/profile-grey-icon.svg') }}">
         
          <span class="text-primary">Mi cuenta</span>
        </a>


        @if (Auth::user()->hasCompleteStoreProfile())

        <create-story-menu-button></create-story-menu-button>

        @endif
        @if (Auth::user()->isA('super-user'))
        <a class="dropdown-item py-2" href="{!! url('/admin/settings') !!}" title="Panel de control">
          <img class="fa-fw mr-2"  src="{{ asset('images/icons/profile-menu/admin-icon.svg') }}">
          <span class="text-primary">Administrador</span>
        </a>
        @endif
        {{-- <a class="dropdown-item py-2" href="#">
                      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                      Settings
                    </a>
                    <a class="dropdown-item py-2" href="#">
                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                      Activity Log
                    </a> --}}
        <div class="dropdown-divider mx-4"></div>
        <a class="dropdown-item py-2" href="#" data-toggle="modal" data-target="#logoutModal" title="Cerrar sesión">
          <img class="fa-fw mr-2"  src="{{ asset('images/icons/profile-menu/logout-icon.svg') }}" >
          Cerrar sesión
        </a>
      </div>
    </li>

    <!-- Nav Item - Messages -->
    <notifications-list></notifications-list>


    @else
    <a class="nav-link mx-2" href="{{url('/login?register')}}">
      <img class="small-icon-size" title="Log In" src="{{ setting('user_icon', asset('images/icons/top-menu/profile-icon.svg')) }}">
    </a>
    @endif



    <a href="{{url('/account/products')}}" class="text-white" title="Crear productos para vender">
      <div
        class="ml-2 py-3 d-flex btn border-primary bg-primary align-items-center rounded-bottom-left btn-menu-vender">
        <img src="{{ setting('sell_icon', asset('images/icons/top-menu/shirt-money.svg')) }}" class="small-icon-size ml-3">
        <span class="mx-2 text-white">VENDER</span>
      </div>
    </a>

    <!-- Nav Item - User Information -->


    {{-- <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="https://placehold.it/50x50"
                             class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{!! Auth::user()->name !!}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="https://placehold.it/50x50"
                                 class="img-circle" alt="User Image"/>
                            <p>
                                {!! Auth::user()->name !!}
                                <small>Member since {!! Auth::user()->created_at->format('M. Y') !!}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Sign out
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display:
    none;">
    {{ csrf_field() }}
    </form>
  </div>
  </li>
</ul>
</li>
</ul>
</div> --}}

</div>


</ul>



</nav>



<nav class="d-flex w-100 d-md-none fixed-top">


<!-- Sidebar Toggle (Topbar) -->


<!-- Topbar Navbar -->
<ul class="navbar-nav my-0 py-0 w-100 p-3">

  <!-- Nav Item - Search Dropdown (Visible Only XS) -->
  <div class="d-flex justify-content-between w-100">

    @if (auth()->check())
    <li class="nav-item dropdown no-arrow mx-2 mob-fixed--icon align-self-center">
      <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">

        {{-- <img class="small-icon-size" src="{{ asset('images/icons/top-menu/profile-icon.svg') }}"> --}}
        <img class="avatar-sm rounded-circle" src="{{ auth()->user()->avatar_image }}">
        
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow p-0 opacity-9" aria-labelledby="userDropdown">
        <a class="dropdown-item py-2" href="{!! url('/account/profile') !!}" title="Área personal">
          <img class="fa-fw mr-2"  src="{{ asset('images/icons/profile-menu/profile-grey-icon.svg') }}">
         
          <span class="text-primary">Mi cuenta</span>
        </a>


        @if (Auth::user()->hasCompleteStoreProfile())

        <create-story-menu-button></create-story-menu-button>

        @endif
        @if (Auth::user()->isA('super-user'))
        <a class="dropdown-item py-2" href="{!! url('/admin/settings') !!}">
          <img class="fa-fw mr-2"  src="{{ asset('images/icons/profile-menu/admin-icon.svg') }}">
          <span class="text-primary">Administrador</span>
        </a>
        @endif
        {{-- <a class="dropdown-item py-2" href="#">
                      <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                      Settings
                    </a>
                    <a class="dropdown-item py-2" href="#">
                      <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                      Activity Log
                    </a> --}}
        <div class="dropdown-divider mx-4"></div>
        <a class="dropdown-item py-2" href="#" data-toggle="modal" data-target="#logoutModal" title="Cerrar sesión">
          <img class="fa-fw mr-2"  src="{{ asset('images/icons/profile-menu/logout-icon.svg') }}" >
          Cerrar sesión
        </a>
      </div>
    </li>

    <!-- Nav Item - Messages -->
    <notifications-list></notifications-list>


    @else
    <a class="mx-2 scale-0-6 transform-left mob-fixed--icon p-2 p-md-0" href="{{url('/login?register')}}">
      <img class="small-icon-size" src="{{ asset('images/icons/top-menu/profile-icon.svg') }}">
    </a>
    @endif


</div>


</ul>



</nav>