@extends('layouts.account')


  @section('title')
    Pregunta
  @endsection


@section('content')
<div class="container mt-5">
  @include('flash::message')
  @include('adminlte-templates::common.errors')
  <div class="card o-hidden border-0 shadow-lg my-2">
    <div class="card-body">
      <p><strong>Publicado por: {{ $question->user->full_name }}</strong>
        <small>{{ $question->created_at->diffForHumans() }}</small></p>

      @if ($question->product)
      <p>Producto: {{ $question->product->name }}</p>
      @endif
      <p> {{ $question->body }} </p>
    </div>
  </div>


  <div class="card o-hidden border-0 shadow-lg my-1">
    <div class="card-body">
      @include('account.questions.answers.index', ['answers' => $question->answers])
      <form class="my-3" action="{{ route('account.answers.store') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <textarea class="form-control" name="body" placeholder="Responder..."></textarea>
          <input class="form-control" name="question_id" hidden value="{{ $question->id }}">
        </div>
        <button class="btn btn-primary">
          <i class="fa fa-question"></i> Publicar respuesta
        </button>
        <a class="btn" href="{{url('account/answers')}}">Regresar</a>
      </form>
    </div>
  </div>



</div>
@endsection
