@extends('layouts.account')



@section('title')
    Calificaciones de mis productos
@endsection


@section('content')
<div class="content container mt-4">
  @include('flash::message')

  <div class="">
  @foreach ($reviews as $review)
  <div class="my-2 card">
    <div class="card-body">
    <div class="font-weight-bold text-primary mb-2">Producto: <a href="{{$review->reviewable->product_variant->product->url}}">{{$review->reviewable->product_variant->product->name}}</a></div>
      @include('partials.reviews.review-card', ['user' => $review->user])
    </div>

    {{-- @if (!$review->answer)
    <a href="{{ route('account.storeReviews.edit', $review->id)}}"  class="btn btn-primary m-3">Responder</a>
    @endif --}}
  </div>
  
  
  
  @endforeach
</div>
  <div class="text-center">
    {{ $reviews->links() }}
  </div>
</div>
@endsection
