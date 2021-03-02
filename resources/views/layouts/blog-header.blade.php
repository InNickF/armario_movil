<!DOCTYPE html>
<html>
@include('partials.head')

<body id="page-top">
    @include('partials.tag-manager-body-code')
    <div id="app">
        <div id="wrapper">
            <div id="content-wrapper" class="d-flex flex-column">
                <div class="bg-gradient">

                    <!-- Main Header -->
                    @include('partials.top-menu', ['bgColor' => 'dark'])
                    <!-- Content Wrapper. Contains page content -->
                    <div class="container-fluid">
                        <div>
                            <div class="home-top-bg">
                                <div class="logo-home d-flex justify-content-center align-content-center mt-5 mt-md-0 ">
                                    <a href="{{url('/')}}" class="d-inline-block mx-auto mb-5 mt-3 mb-4 ">
                                        <img src="{{setting('logo_image', asset('images/icons/logo-armario-movil.png'))}}" class="image-svg header-main-logo mx-auto d-block " alt="">
                                    </a>
                                </div>
                                {{ Widget::parentCategoryMenu( ['categoryId' => null] ) }}



                                {{-- <div class="d-flex justify-content-center my-3">
                                        <img src="{{  asset('images/logos/gradient-line-large.png') }}" alt="">
                            </div> --}}
                        </div>
                        <div class="mt-1 text-center">
                            <img src="{{ url('/images/logos/gradient-line-large.png')}}" class="mb-4 img-fluid" />
                            <div> <a class="text-center h3 text-white font-weight-bold mb-4" href="{{url('blog')}}"> Blog de Armario Móvil</a></div>
                            <div class="text-white text-center mb-4">Conoce las nuevas tendencias y el mejor camino crear tu propia moda aquí</div>
                        </div>
                    </div>
                    @yield('content-top')
                </div>
            </div>
            <div class="bg-white">
                @yield('content-bottom')
                {{ Widget::run('testimonials') }}
            </div>
            @include('partials.footer.footer-front')
        </div>
    </div>
    <!-- End of Page Wrapper -->
    @include('partials.modals')
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top full-rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    </div>
    @include('partials.scripts')
</body>

</html>