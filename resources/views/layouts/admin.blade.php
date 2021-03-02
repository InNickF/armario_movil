<!DOCTYPE html>
<html>

@include('partials.head')

<body id="page-top">

        @include('partials.tag-manager-body-code')

    <div id="app">
        <div id="overlay-blue"></div>

        <div id="wrapper">

        @include('partials.sidebar.sidebar-admin-menu')


            <div id="wrapper-sidebar" class="w-100 header-text-overflow-hidden">

                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Header -->
                    {{-- @include('partials.top-menu') --}}

                    <!-- Content Wrapper. Contains page content -->
                    <div class="container mt-3">
                        @yield('content')

                    </div>
                        <div class="">
                            <div class="float-btn-admin text-center d-lg-none">
                                <div class="mx-auto p-3">
                                    <a href="#" class="mx-auto img-fluid" data-toggle="modal" data-target="#mobSidebarAdmin" >
                                        <img class="btn-menu-responsive img-fluid p-2" src="{{ asset('images/n-sidebar-menu-mob.png') }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>


                    @include('partials.footer.footer')

                    
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
    <script src="{{url('js/admin.js')}}"></script>
</body>

</html>



