<div class="card col-12 mx-auto box-shadow mb-3 px-4 pt-3 pb-4">
  <div class="rounded">
    <div class="aside">
      <a href="{{ url('/preguntas-frecuentes/' . $faq->slug) }}">
      <div class="h4 text-primary mt-2">{{ $faq->title }}</div>
      {{-- <div class="d-flex align-items-center">
       
          <img class="img-fluid rounded-circle mr-1 my-1 avatar-sm" src="{{ $faq->user->avatar_image }}">
        
        <div class="d-flex ml-2">
          <div class="h6 text-grey">
            @if ($faq->user)
            <div>{{ $faq->user->faqs->count() }} artículos escritos</div>
            <div class="">Escrito por: {{ $faq->user->full_name }}</div>
            @endif
          </div>
        </div>
      </div> --}}

      <div class="text-primary-transparency mt-2 mb-0 text-sm">{!!$faq->description!!}</div>

    </a>
    </div>
  </div>
</div>
