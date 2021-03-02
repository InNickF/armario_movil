<!DOCTYPE html>
<html>

@include('partials.head')

<body id="page-top">

  @include('partials.tag-manager-body-code')

  <div id="app">
    <div id="wrapper" class="flex-wrap">

      <!-- Content Wrapper. Contains page content -->
      <div class="container-fluid header-login pr-0">
        @include('partials.top-menu', ['bgColor' => 'dark'])
        <div class=" py-2">
          <div class="logo-home text-center pt-2">
            <a class="my-3" href="{{url('/')}}">  
              <img src="{{setting('logo_image', asset('images/icons/logo-armario-movil.png'))}}" class="image-svg header-main-logo" alt=""></a>
            {{ Widget::parentCategoryMenu( ['categoryId' => null] ) }}
          </div>
        </div>
      </div>

      <div class="container-fluid cont-login">
        <div class=" py-3">

          @yield('content')
        </div>

      </div>



    </div>
    <div class="top-cont-suscribete mt-5"> </div>
    <div class="cont-suscribete suscribete-login">

      @include('partials.footer.footer-front-form')

      @include('partials.footer.footer-front-icons')

    </div>
    <div class="">
      @include('partials.footer.footer-front-pages')

      @include('partials.footer.footer-front-bottom-line')

    </div>

    {{-- <div class="footer-front my-5">
    <img src="images/footer-front.png" class="w-100" alt="">
</div> --}}

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
