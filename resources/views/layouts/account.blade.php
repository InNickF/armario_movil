<!DOCTYPE html>
<html>

@include('partials.head')

<body id="page-top" class="vh-100">
  
    @include('partials.tag-manager-body-code')
  
  <div id="app">
    <div id="overlay-blue"></div>
    <div id="wrapper" class=""> 

      @include('partials.sidebar.sidebar-menu')
 
      <div id="wrapper-sidebar" class="w-100 header-text-overflow-hidden">
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- content-shadow-overflow-visible -->

        <!-- Main Header -->

        <!-- Content Wrapper. Contains page content -->
        <div class="container-fluid p-0 container-dashboard">

          <div class="row content-header">
<section class="col-12 d-flex justify-content-between align-items-center">
  <h1 class="mb-0 mr-5 ml-3 text-left">@yield('title')</h1>
   <!-- Nav Item - Messages -->
   <ul class="navbar-nav ml-auto my-0 py-0 ">
   <div class="d-flex align-items-center mr-3">
     <notifications-list class="d-flex align-items-cente"></notifications-list>
   </div>
   </ul>
</section>
</div>


          @yield('content')

        </div>


    <div id="cont-menu-responsive-pr" class="d-flex d-lg-none flex-column">
    <div class="d-flex w-100 justify-content-around my-2 my-sm-4 mt-md-5">

    <div class="position-relative">
    <a class="go-back rounded" href="{{ URL::previous() }}">
    <img class="nav-link icon-menu__responsive icon-menu__responsive__arrow" src="{{ asset('images/left-arrow-mob-menu.png') }}">
    </a>
    </div>

    <div style="width:39%" class="d-flex justify-content-around align-content-center">
    <a href="#" class="float-btn btn-menu-responsive" data-toggle="modal" data-target="#mobSidebar" ><img src="{{ asset('images/n-sidebar-menu-mob.png') }}" alt=""></a>
    </div>

    <div>
    <a class="scroll-to-top-responsive rounded" href="#page-top">
    <img class="nav-link icon-menu__responsive icon-menu__responsive__arrow mob-menu--arrow__toggle" src="{{ asset('images/arrow_menu_responsive.png') }}">
    </a>
    </div>

    </div>

</div>
<div style="z-index:10000;" class="btn-menu-responsive-close">
  
    </div> 


<!-- {{-- RESPONSIVE MENU BOTTOM --}}
<div class="cont-menu-responsive  d-md-none d-lg-none d-xl-none">
  <div class="btn-menu-responsive">
  </div>

  {{-- GO BACK --}}
  <div class="position-absolute responsive-menu-icon-left">
    <a class="go-back rounded" href="{{ URL::previous() }}">
      <i class="fas fa-angle-left"></i>
    </a>
  </div>

  {{-- SCROLL TO TOP --}}
  <div class="position-absolute responsive-menu-icon-right">
    <a class="scroll-to-top-responsive rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
  </div>
</div>
    -->

      </div>
 </div>
    </div>
    <!-- End of Page Wrapper -->
    @include('partials.footer.footer')
    
    

    
    
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top full-rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    
    @include('partials.modals')
  </div>

  @include('partials.scripts')
</body>

</html>
