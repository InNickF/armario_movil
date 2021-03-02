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


      {!! Form::model($review, ['route' => ['account.reviews.update', $review->id], 'method' => 'patch']) !!}

      @include('account.reviews.fields')

      {!! Form::close() !!}

    </div>
  </div>



</div>
@endsection
