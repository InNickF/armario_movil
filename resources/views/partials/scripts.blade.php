<script src="{{ asset('js/vendor.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/js/swiper.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset="utf-8"></script>

{{-- Paymentez --}}
<script src="{{config('services.paymentez.js')}}"></script>
<script src="{{config('services.paymentez.checkout')}}"></script>



<script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>


{{-- Promise polyfill --}}
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js"></script>

@include('sweetalert::alert')

 <!-- Laravel Javascript Validation -->
 <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
 @yield('js-validator')



<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/all.js') }}"></script>

@yield('scripts')
