@extends('layouts.account')



@section('title')
     Reseña
  @endsection

@section('content')
<div class="content">
  @include('flash::message')
  @include('adminlte-templates::common.errors')
  <div class="card o-hidden border-0 shadow-lg my-2">
    <div class="card-body">
      <small>{{ $review->created_at->diffForHumans() }}</small></p>


      <div class="mb-3">
        <image-rating src="{{asset('/images/rating/bag-1.png')}}"  :rating="{{ (int)$review->rating }}"></star-rating>
      </div>

      <p>{{$review->body}}</p>

    </div>
  </div>

  @if (!$review->answer)
  <div class="card o-hidden border-0 shadow-lg my-1">
    <div class="card-body">
      <form class="my-3" action="{{ url('account/reviewAnswers') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <textarea class="form-control" name="body" placeholder="Responder..."></textarea>
          <input class="form-control" name="review_id" hidden value="{{ $review->id }}">
        </div>
        <button class="btn btn-primary">
          <i class="fa fa-question"></i> Publicar respuesta
        </button>
        <a class="btn" href="{{url('account/reviews')}}">Regresar</a>
      </form>
    </div>
  </div>
  @else
  <div class="card o-hidden border-0 shadow-lg my-1">
    <div class="card-body">
      <h4>Respuesta:</h4>
      <p>{{$review->answer->body}}</p>
    </div>
  </div>
  @endif



</div>
@endsection
