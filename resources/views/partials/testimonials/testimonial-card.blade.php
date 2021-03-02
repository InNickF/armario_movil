<div class="d-md-flex d-block testimonial-card px-4 py-2">


  <div class="m-2">
    <div class="bg-cover bg-center rounded-circle avatar-sm-md"
      style="background-image:url('{{$testimonial->user->avatar_image}}')">

    </div>
    {{-- <img class="img-fluid rounded-circle " src="{{ $testimonial->user->avatar_image }}"> --}}
  </div>

  <div class="p-3 d-flex align-items-top flex-fill">
    <div class="w-100">
      <h5 class="title my-2 text-primary font-weight-bold">
        @if ($testimonial->user)
        {{ $testimonial->user->full_name }}
        @endif
      </h5>
      <p class="text-sm text-bold text-primary">{{$testimonial->user->city}}, {{ upper_case($testimonial->user->country) }}</p>
      <div style="min-height:70px;" class="position-relative">
        <p style="color:#777;" class="font-italic">
          {!! $testimonial->body !!}
        </p>
        <img src="{{ asset('images/icons/quotation-marks-open-icon.svg') }}" class="quotation-top icon-sm">
        <img src="{{ asset('images/icons/quotation-marks-close-icon.svg') }}" class="quotation-bottom icon-sm">
      </div>
    </div>
    <!-- price-wrap.// -->
  </div>

</div>
