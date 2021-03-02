@extends('layouts.followed-categories')

@section('content-bottom')
<section class="content-header">
  <div class="text-center mt-4">
    <div class="pull-left text-primary mb-0 h3">Elige las categorías que más te interesen</div>
  </div>
</section>

<div class="content">
  <div class="clearfix"></div>

  @include('flash::message')
  @include('adminlte-templates::common.errors')

  <div class="clearfix"></div>

  <followed-categories :parents="{{json_encode($categories)}}" :subcategories="{{json_encode($subcategories)}}"></followed-categories>

</div>

@include('partials.footer.footer-preference')
@endsection