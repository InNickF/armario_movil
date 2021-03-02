@extends('layouts.blog-header')

@section('content-bottom')

<div class="container">
  <div class="row">

    <div class="col-12">
      <section class="content-header mt-4">
        @if ($post->categories->count())
        <h1 class="pull-left text-grey mb-3">{{$post->categories[0]->name}}</h1>
        @endif
      </section>

      <div class="col-12 text-center mb-5">
        <div style="border-radius:50px;" class="mt-2 px-5 card bg-light-grey border-none py-1 d-inline-block">
          <div class="d-inline-flex justify-content-center p-2 text-center flex-wrap">
              @foreach ($categories as $category)
              <a class="text-center" style="min-width:190px;" href="{{ $category->url }}">
              <div class="mx-5 my-2 my-md-0 text-center text-primary">{{$category->name}}</div>
            </a>
              @endforeach
            </div>
        </div>
        </div>

      <h1 class="mt-5 text-primary text-left">
        {{$post->title}}
      </h1>
      <div class="text-primary-transparency">{{$post->author->first_name}} {{$post->author->last_name}}</div>
      <div class="text-primary-transparency">Fecha de creación: {{$post->created_at}}</div>
      <div class="d-flex flex-wrap mb-4">
         <a href="https://www.facebook.com/sharer/sharer.php?u={{ $post->url }}" target="_blank">
            <img src="{{ url('/images/icons/single-product/facebook-icon-small-grey.png')}}" alt class="mx-1" />
          </a>
          <a href="https://pinterest.com/pin/create/button/?url={!! $post->main_image !!}&media={!! $post->main_image !!}&description={!! $post->title !!}"
            target="_blank">
            <img src="{{ url('/images/icons/single-product/pinterest-icon-small-grey.png')}}" alt class="mx-1" />
          </a>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-12 col-lg-9 pr-0 pr-lg-5">
      <div class="content mx-auto html-body-container">


        <div style="background-image:url('{{ $post->main_image }}')"
          class="bg-center img-lg mx-auto col-12 rounded mb-4 bg-cover bg-no-repeat"></div>
        <p class="mb-5">{!! html_entity_decode($post->body) !!}</p>


        <post-comment-list :post-id="{{$post->id}}" user-name="{{ auth()->check() ? auth()->user()->full_name : ''}}">
        </post-comment-list>

      </div>


    </div>
    <div class="col-12 col-lg-3 mt-3 mt-lg-0">
      @include('blog.blog-search-bar-small')

      <div class="card rounded my-4 shadow-sm">
        <div class="rounded">
          <div class="px-3 py-2 mb-0 bg-primary rounded h5 text-white"><strong>Categorías</strong></div>
          <div class="card-body py-2">
            @foreach ($categories as $category)
            <a href="{{ $category->url }}">
              <div class="my-1 text-primary-transparency">{{$category->name}}</div>
            </a>
            @endforeach
          </div>
        </div>
      </div>
      <div class="card rounded my-4 shadow-sm">
        <div class="rounded">
          <div class="px-3 py-2 mb-0 bg-primary rounded h5 text-white"><strong>¡Síguenos!</strong></div>
          <div class="card-body py-2">
            <a href="https://www.facebook.com/ArmarioMovilOficial/">
              <img src="{{ url('/images/icons/facebook-icon-small-blue-transparency.png')}}" alt class="mx-1 icon-xs" />
            </a>
            <a href="https://www.instagram.com/armariomovil/">
              <img src="{{ url('/images/icons/instagram-icon-small-blue-transparency.png')}}" alt
                class="mx-1 icon-xs" />
            </a>
            <a href="https://www.pinterest.com/armariomovil/">
              <img src="{{ url('/images/icons/pinterest-icon-small-blue-transparency.png')}}" alt
                class="mx-1 icon-xs" />
            </a>
          </div>
        </div>
      </div>
      <div class="card rounded my-4 shadow-sm">
        <div class="rounded">
          <div class="px-3 py-2 mb-0 bg-primary rounded h5 text-white"><strong>Artículos recientes</strong></div>
          <div class="card-body py-2">
            @foreach ($latestPosts as $post)
          <a href="{{$post->url}}" class="my-1 h5"><strong>{{$post->title}}</strong></a>
            <div class="my-1 text-primary-transparency text-sm mb-4"><small>{{$post->description}}</small></div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="mt-5 px-5 py-4 d-flex align-items-center bd-highlight border-top border-bottom">
        <div class="row w-100">
          <div class="col-12 col-md-6  d-flex justify-content-start flex-wrap">
            <img class="p-2 bd-highlight img-fluid avatar-sm-md rounded-circle mr-1"
              src="{{ $post->author->avatar_image }}">
            <div class="align-self-center">
              <div class="bd-highlight text-sm text-primary">{{$post->author->first_name}} {{$post->author->last_name}}
              </div>
              <div class="bd-highlight text-sm text-primary-transparency"><small>Fecha de creación:
                  {{$post->created_at}}</small></div>
            </div>
          </div>
          <div
            class="ml-auto p-2 bd-highlight mb-4 col-12 col-md-6 d-flex justify-content-start justify-content-md-end flex-wrap text-rigth">
            <span class="text-primary text-sm text-rigth">Compartir artículo</span>
            <div class="w-100 d-flex justify-content-start justify-content-md-end">
             <a href="https://www.facebook.com/sharer/sharer.php?u={{ $post->url }}" target="_blank">
            <img src="{{ url('/images/icons/single-product/facebook-icon-small-grey.png')}}" alt class="mx-1" />
          </a>
          <a href="https://pinterest.com/pin/create/button/?url={!! $post->main_image !!}&media={!! $post->main_image !!}&description={!! $post->title !!}"
            target="_blank">
            <img src="{{ url('/images/icons/single-product/pinterest-icon-small-grey.png')}}" alt class="mx-1" />
          </a>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-5 mb-3 text-primary text-center">También te puede interesar</div>

      <div class="card-columns mx-auto">
        @foreach ($posts as $post)
        <div class="card o-hidden border-0 shadow-sm my-3">
          <div class="card-body p-0">
            <div style="background-image:url('{{ $post->main_image }}')" class="bg-center img-md bg-cover"></div>
            {{-- <img src="{{$post->main_image}}" alt="" class="img-md w-100"> --}}
            <a href="{{$post->url}}">
              <h2 class="text-primary text-left pt-3 pl-3 pr-5"><strong>{{$post->title}}</strong></h2>
            </a>
            <p class="px-3 text-primary-transparency">{{$post->description}}</p>
            <div class="row px-3 mb-2">
              <div class="col-12">
                @if ($post->categories->count())

                <p class="text-primary text-sm h6 mb-0"><span class="font-weight-bold"><small>Categoría:
                    </small></span><small>{{$post->categories[0]->name}}</small></p>
                @endif
                <p class="text-primary text-sm h6"><span class="font-weight-bold"><small>Fecha:
                    </small></span><small>{{$post->created_at->toDateString()}}</small></p>
              </div>
              <div class="col-12 pr-2 text-right">
                <a href="{{$post->url}}"
                  class="btn btn-primary font-weight-bold text-center w-100 mt-3 mb-2"><small>Más información</small></a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>


      <div class="col-12 text-center mb-5">
        <a href="{{ url('blog/')}}" class="btn-sm btn btn-outline-primary font-weight-bold px-5 mt-4">Volver al
          inicio del blog</a>
      </div>
    </div>
  </div>
</div>

@endsection
