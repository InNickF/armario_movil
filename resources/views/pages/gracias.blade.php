@extends('layouts.app-front')


@section('content-top')
@endsection

@section('content-bottom')

<div class="row">
  <div class="col-8 mx-auto text-center mt-4 mb-5">
    <img src="{{asset('/images/circle-bag-check.svg')}}" alt="..." class="img-md-3">
    <div class="h1 text-primary mt-2">¡Gracias por tu compra!</div>
    <div class="text-primary ">Tu compra ha sido efectuada correctamente, en los próximos minutos enviaremos tu pedido.
    </div>
    <div class="text-primary">Puedes ver el tracking de tu pedido en la sección mis compras.</div>
    <div class="d-flex align-items-center justify-content-center mt-4">
      <div>
        <a href="{{url('account/orders/')}}">
          <div class="btn btn-sm btn-outline-primary font-weight-bold px-4 mx-3">Ir a mis compras</div>
        </a>
      </div>
      <div>
        <a href="{{ url("/") }}">
      <div class="btn btn-sm btn-primary font-weight-bold px-4 mx-3">Regresar al incio</div>
    </a>
    </div>
    </div>
  </div>
</div>

{{ Widget::run('testimonials') }}

@endsection
