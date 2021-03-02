@extends('layouts.blog-header')


@section('content-bottom')

<section class="content-header mt-5">
    
        <h1 class="pull-left text-grey mb-3">{{$category->name}}</h1>
  
  @include('blog.blog-search-bar')
</section>
{{-- <div class="row"> --}}
    
  {{-- <div class="input-group col-lg-6 col-md-6">
    <form>
      <div class="d-flex mt-4">
        <input name="search" type="text" value="{{ $search }}" class="form-control bg-light border-secondary"
          placeholder="Buscar..." aria-label="Buscar" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">
            <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
      </div>
    </form>
  </div> --}}
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
{{-- </div> --}}


<div class="container mt-4">
  <div class="row card-deck">
    @forelse ($posts as $post)
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card o-hidden border-0 shadow-sm">
        <div class="card-body p-0">
          <a href="{{$post->url}}">
              <div style="background-image:url('{{ $post->main_image }}')" class="bg-center img-md bg-cover"></div>
          </a>
          {{-- <img src="{{$post->main_image}}" alt="" class="img-md w-100"> --}}
          <a href="{{$post->url}}">
            <h2 class="text-primary text-left pt-3 pl-3 pr-5"><strong>{{$post->title}}</strong></h2>
          </a>
          <p class="px-3 text-primary-transparency">{{ $post->description }}</p>
        </div>
        <div class="card-footer bg-transparent border-0">
              <div class="row px-3 mb-2">
                <div class="col-12">
                  @if ($post->categories->count())
                      
                  <p class="text-primary text-sm h6 mb-0"><span class="font-weight-bold"><small>Categoría: </small></span><small>{{$post->categories[0]->name}}</small></p>
                  @endif
                  <p class="text-primary text-sm h6"><span class="font-weight-bold"><small>Fecha: </small></span><small>{{$post->created_at->toDateString()}}</small></p>
                </div>
              </div>
                  <div class="col-12 pr-2 text-right">
                    <a href="{{$post->url}}" class="btn btn-primary font-weight-bold text-center w-100 my-3">Más información</a>
                  </div>

        </div>
      </div>
    </div>
    @empty
    <p>No se han encontrado resultados</p>
    @endforelse
  </div>
  <div class="text-center">
    {{ $posts->links() }}
  </div>
</div>
@endsection
