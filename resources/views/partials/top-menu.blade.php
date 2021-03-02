<!-- Topbar -->

    @include('partials.top-menu.right-buttons')

<!-- End of Topbar -->

<div id="cont-menu-responsive-pr" class="d-flex d-sm-flex d-md-none flex-column">
    <div class="d-flex w-100 justify-content-around my-2 my-sm-4">

    <div class="position-relative">
    <cart-icon icon="{{ setting('cart_icon', asset('images/icons/top-menu/bag-cart-icon.svg')) }}" v-on:get-cart="getCart"></cart-icon>
    </div>

    <div style="width:39%" class="d-flex justify-content-around align-content-center">
    <a href="#" class="float-btn" data-toggle="modal" data-target="#globalSearch"><img src="{{ asset('images/n-search-menu-mob.png') }}" alt=""></a>
    </div>

    <div>
    <div><img id="mobMenuArrowToggle" class="nav-link icon-menu__responsive icon-menu__responsive__arrow" src="{{ asset('images/arrow_menu_responsive.png') }}"></div>
    </div>

    </div>

    <div id="mobMenuContainerToggle" class="d-flex w-100 justify-content-around mb-2">

    <div><a href="{{url('/')}}"><img class="nav-link icon-menu__responsive" src="{{ asset('images/n-home-menu-mob.png') }}"></a></div>

    <div><a href="#" data-toggle="modal" data-target="#globalCategorySearch"><img class="nav-link icon-menu__responsive" src="{{ asset('images/n-category-menu-mob.png') }}"></a></div>
    <div><a href="{{url('/account/wishlist')}}"><img class="nav-link icon-menu__responsive" src="{{ asset('images/n-fav-menu-mob.png') }}"></a></div>

    <div><a href="{{setting('landing_url')}}"><img class="nav-link icon-menu__responsive" src="{{ asset('images/n-prom-menu-mob.png') }}"></a></div>
    </div>
</div>
<!-- End nav responsive -->
      
      {{-- <header class="">

    <!-- Logo -->
    <a href="#" class="logo">
        <b>Armario Móvil</b>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        
    </nav>
</header> --}}
