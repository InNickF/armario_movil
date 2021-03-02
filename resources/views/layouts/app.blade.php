<!DOCTYPE html>
<html>

@include('partials.head')

<body id="page-top">

        @include('partials.tag-manager-body-code')

    <div id="app">
        <div id="wrapper" class="">

            <div id="content-wrapper" class="d-flex flex-column bg-gradient">

                <!-- Main Header -->
                @include('partials.top-menu')

                <!-- Content Wrapper. Contains page content -->
                <div class="container-fluid">
                    @yield('content')
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
</body>

</html>
