<!DOCTYPE html>
<html>

@include('partials.head')

<body id="page-top">

    @include('partials.tag-manager-body-code')

  <div id="app">
    <div id="wrapper">
      <div id="content-wrapper" class="d-flex flex-column">
      <div class="bg-cover bg-gradient__large" style="background-image: url('{{ setting('header_bg_image', url("/images/backgrounds/home-background.png")) }}')">

          <!-- Main Header -->
          @include('partials.top-menu', ['bgColor' => 'dark'])
          <!-- Content Wrapper. Contains page content -->
          <div class="container-fluid">
            @yield('content-top')
          </div>

        </div>

        <div class="bg-white">
          @yield('content-bottom')
        </div>

        @include('partials.footer.footer-front')

      </div>
    </div>
    <!-- End of Page Wrapper -->
    
    
    
    
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top full-rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
  </a>
  
  @include('partials.modals')
</div>
  
  @include('partials.scripts')
</body>

</html>