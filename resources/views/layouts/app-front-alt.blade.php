<!DOCTYPE html>
<html>

@include('partials.head')

<body id="page-top">

  @include('partials.tag-manager-body-code')

  <div id="app">
    <div id="wrapper">

      <div id="content-wrapper" class="d-flex flex-column">
        <div class="bg-cover bg-gradient">

          <!-- Main Header -->

          @include('partials.top-menu', ['bgColor' => 'dark'])

          <!-- Content Wrapper. Contains page content -->
          <div class="container-fluid mb-0">


            <div>
              <div class="home-top-bg">
                <div class="logo-home d-flex justify-content-center align-content-center mt-5 mt-md-0 ">
                  <a href="{{url('/')}}" class="d-inline-block mx-auto mb-5 mt-3 mb-4 ">
                    <img src="{{setting('logo_image', asset('images/icons/logo-armario-movil.png'))}}"
                      class="image-svg header-main-logo mx-auto d-block " alt="">
                  </a>
                </div>

                {{-- <div class="d-flex justify-content-center my-3">
                                <img src="{{  asset('images/logos/gradient-line-large.png') }}" alt="">
              </div> --}}

            </div>
          </div>
          @yield('content-top')
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
