<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<link href="{{ asset('/css/app.css')}}" rel="stylesheet">

<body id="page-top" class="vh-100">
    <div id="overlay-blue"></div>
    <div id="wrapper-dashboard" class="container-fluid m-0 p-0">
      @yield('content')
    </div>
    <!-- End of Page Wrapper -->
    @include('partials.footer.footer')
  @include('partials.scripts')
</body>

</html>
