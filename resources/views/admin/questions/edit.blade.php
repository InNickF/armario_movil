@extends('layouts.admin')

@section('content')
<section class="content-header">
  <h1>
    Pregunta
  </h1>
</section>
<div class="content">
  @include('flash::message')
  @include('adminlte-templates::common.errors')
  <div class="card o-hidden border-0 shadow-lg my-2">
    <div class="card-body">
      <p>
          @if ($question->user)
        <strong>Publicado por: {{ $question->user->full_name }}</strong>
        @endif
        <small>{{ $question->created_at->diffForHumans() }}</small></p>

      @if ($question->product)
      <p>Producto: {{ $question->product->name }}</p>
      @endif
      <p> {{ $question->body }} </p>
    </div>
  </div>


  <div class="card o-hidden border-0 shadow-lg my-1">
    <div class="card-body">
      @include('admin.questions.answers.index', ['answers' => $question->answers])
    </div>
  </div>
</div>
@endsection
