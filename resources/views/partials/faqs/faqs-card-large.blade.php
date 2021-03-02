<div class="row">

<div class="card col-10 col-md-6 mx-auto box-shadow mb-5 px-4 pt-3 pb-4">
    <div class="rounded">
      <div class="aside">
        <div class="h3 text-primary mt-2">{{$faq->title}}</div>
        <div class="d-flex align-items-center">
  
          {{-- <img class="img-fluid rounded-circle mr-1 my-1 avatar-sm" src="{{ $faq->user->avatar_image }}">
  
          <div class="d-flex ml-2">
            <div class="h6 text-grey">
              @if ($faq->user)
              <div>{{ $faq->user->faqs->count() }} artículos escritos</div>
              <div class="">Escrito por: {{ $faq->user->full_name }}</div>
              @endif
            </div>
          </div> --}}
        </div>

        <div class="html-body-container">
          <p>{!! html_entity_decode($faq->body) !!}</p>
        </div>

      </div>
    </div>
  
  </div>
</div>


<div class="row">
  <div class="col-3"></div>
  <div class="col-6">

  <div class="d-flex flex-wrap justify-content-center justify-content-lg-between">
    
    @if (count($faq->categories))
      <a href="{{ url("/") }}/preguntas-frecuentes/categorias/{{ $faq->categories[0]->slug }}" class="">
        <div class="btn btn-sm btn-primary my-3 my-lg-0 font-weight-bold">
          <i class="fas fa-chevron-left mr-2"></i>
        Regresar a la categoría
      </div>
      </a>
      
    @endif

    <div class="d-flex align-self-end justify-content-center justify-content-lg-between">
    @if ($prevFaq)
    <a href="{{ url("/") }}/preguntas-frecuentes/{{ $prevFaq->slug }}" class="">
      <div class="btn btn-sm btn-outline-primary mr-2 my-3 my-lg-0 font-weight-bold">
          <i class="fas fa-chevron-left mr-2"></i>
        Artículo anterior
      </div>
    </a>
    @endif

    @if ($nextFaq)
    <a href="{{ url("/") }}/preguntas-frecuentes/{{ $nextFaq->slug }}" class="btn btn-sm btn-outline-primary my-3 my-lg-0 font-weight-bold">
      <div>
      Siguiente artículo
      <i class="fas fa-chevron-right ml-2"></i>
    </div>
  </a>
    @endif
    </div>
  </div>
</div>
</div>

