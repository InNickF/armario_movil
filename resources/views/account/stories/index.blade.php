@extends('layouts.account')
@section('title')
    Mis historias
@endsection


@section('content')

<div class="content mt-4 container-fluid">
  <div class="clearfix"></div>

  @include('flash::message')

  <div class="clearfix"></div>
  <div class="container-fluid mt-2 scroll-tables-div__important">
    <div class="min-width-tables-div__important">
    @include('account.stories.table')
    </div>
  </div>
</div>
<div class="text-sm ml-5 mt-3"><small>NOTA: Si por el tamaño de tu pantalla no puedes ver toda la información, recuerda que puedes hacer scroll horizontal en la tabla para visualizar correctamente todo.</small></div>
@endsection
