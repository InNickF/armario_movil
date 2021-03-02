@extends('layouts.account')

@section('title')
{{$category->name}}
@endsection

@section('content')
<div class="container-fluid">

  <form action="" class="">
  <div class="input-group col-10 col-md-6 mt-3">

      <input name="search" type="text" value="{{ $search }}" class="form-control bg-white border-solid small"
        placeholder="Buscar...">
      <div class="input-group-append">
        <button class="btn btn-primary font-weight-bold" type="submit">
          <div class="">Buscar</div>
        </button>
      </div>
      
      
    </div>
  </form>


  {{-- <form>
      <div class="d-flex mt-4">
        <input name="search" type="text" value="{{ $search }}" class="form-control bg-light border-secondary"
  placeholder="Buscar..." aria-label="Buscar" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <button class="btn btn-primary" type="submit">
      <i class="fas fa-search fa-sm"></i>
    </button>
  </div>
</div>
</form> --}}

{{-- <div class="col-lg-4 col-md-6">
          <form>
          <div class="d-flex">
              <date-selector field-name="date" class="">Fecha</date-selector>
              <button class="btn btn-primary" type="submit">
                  <i class="fas fa-filter fa-sm"></i>
                </button>
          </div>
        </form>
      </div> --}}
</div>


<div class="container">
  <div class="row">
    <div class="card-columns mx-auto px-0 px-sm-4 pt-4">
      @forelse ($articles as $article)
      <div class="card o-hidden border-0 shadow-sm mr-2 mt-2 html-body-container">
        <div class="card-body p-0">
          <div style="background-image:url('{{ $article->main_image }}')" class="bg-center img-md bg-cover"></div>
          <a href="{{url('/account/articles/' . $article->id)}}">
            <h2 class="text-primary text-left pt-3 pl-3 pr-5"> {{$article->title}}</h2>
          </a>
          <p class="px-3 text-primary-transparency">{!! html_entity_decode($article->description) !!}</p>
          <div class="row px-3 mb-2">
            <div class="col-12">
              <p class="text-primary text-sm h6 mb-0"><span class="font-weight-bold"><small>Categoría:
                  </small></span><small>{{$article->categories[0]->name}}</small></p>
              <p class="text-primary text-sm h6"><span class="font-weight-bold"><small>Fecha:
                  </small></span><small>{{$article->created_at->toDateString()}}</small></p>
            </div>
            <div class="col-12 pr-2 text-right">
              <a href="{{ url('account/articles/' . $article->id) }}"
                class="btn btn-primary font-weight-bold text-center w-100 my-3">Saber más</a>
            </div>
          </div>
        </div>
      </div>
      @empty
      <p>No se han encontrado resultados</p>
      @endforelse
    </div>
  </div>
  <div class="text-center">
    {{ $articles->links() }}
  </div>
</div>
@endsection
