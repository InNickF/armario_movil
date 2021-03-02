@extends('layouts.account')



@section('title')
    Mis reseñas
  @endsection


@section('content')
<div class="content mt-4 container-fluid">
  <div class="clearfix"></div>

  @include('flash::message')

  <div class="clearfix"></div>
  @foreach ($reviews as $review)
  <div class="card o-hidden border-0 shadow-lg my-2">
    <div class="card-body">
      <p>{{ $review->created_at->diffForHumans() }}</p>
      <image-rating src="{{asset('/images/rating/bag-1.png')}}" :rating="{{ (int)$review->rating }}" :read-only="true"></image-rating>

      <p> {{ $review->body }} </p>

      <a href="{{ route('account.reviews.edit', $review->id)}}" class="btn btn-primary">Editar</a>
    </div>
  </div>
  @endforeach
  <div class="text-center">

  </div>
</div>
@endsection
