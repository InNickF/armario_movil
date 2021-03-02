<div class="row">

<div class="card col-6 mx-auto box-shadow my-5">
    <div class="rounded">
      <div class="aside">
        <div class="h3 text-primary mt-2">{{$faq->title}}</div>
        <div class="d-flex align-items-center">
  
          <img class="img-fluid rounded-circle mr-1 my-1 avatar-sm" src="{{ $faq->user->avatar_image }}">
  
          <div class="d-flex ml-2">
            <div class="h6 text-grey">
              @if ($faq->user)
              <div>{{ $faq->user->faqs->count() }} artículos escritos</div>
              <div class="">Escrito por: {{ $faq->user->full_name }}</div>
              @endif
            </div>
          </div>
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

  <div class="d-flex flex-wrap justify-content-center justify-content-md-between">
    <a href="{{ url("/preguntas-frecuentes") }}" class="btn btn-primary my-3 my-lg-0">Regresar a la categoría</a>

    <div class="d-flex align-self-end justify-content-center justify-content-lg-between">
    @if ($prevFaq)
    <a href="{{ url("/preguntas-frecuentes") }}/{{ $prevFaq->id }}" class="btn btn-outline-primary mr-2  my-3 my-lg-0">Artículo anterior</a>
    @endif

    @if ($nextFaq)
    <a href="{{ url("/preguntas-frecuentes") }}/{{ $nextFaq->id }}" class="btn btn-outline-primary  my-3 my-lg-0">Siguiente artículo</a>
    @endif
    </div>
  </div>
</div>
</div>

