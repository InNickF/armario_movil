<div class="show-fields">
  <!-- Status Id Field -->

  <div class="row">
    <div class="col-4">
      <div class="row">
        <div class="col-6">
          <div class="text-primary got-medium text-sm">Enviado a:</div>
          <p class="text-sm">{!! $order->shipping_address ? $order->shipping_address->full_address : 'Dirección no
            encontrada'
            !!}</p>
        </div>

        <div class="col-6">
          <div class="text-primary got-medium text-sm">Estado:</div>
          <p class="text-sm">{!! $order->status->name !!}</p>
        </div>

        @if ($order->coupon)
        <div class="col-6">
          <div class="text-primary got-medium text-sm">Cupón:</div>
          <p class="text-sm">{{$order->coupon->code}}</p>
        </div>
        @endif


        @if ($order->billing_document_id)
        <div class="col-6">
          <div class="text-primary got-medium text-sm">Nº de factura:</div>
          <p><small>{{$order->billing_document_id}}</small></p>
        </div>
        @endif
      </div>
    </div>

    <div class="col-6">
      <div class="text-primary got-medium text-sm">Items del pedido:</div>
      <div class="row">
        <div class="col-12">
          @foreach($order->items as $item)
          <div class="d-flex align-items-center mb-3">
            <div class="mr-2 text-primary">{{ $item->quantity }}</div>

            @if ($item->product_variant)
            <div class="">
              <a href="{{ $item->product_variant->product->url }}">
                <div class="avatar-sm rounded-circle mr-3 my-3 bg-center bg-cover"
                  style="background-image:url('{{ $item->product_variant->product->main_image }}')">
                </div>
              </a>
            </div>
            @endif
            <div>
              @if ($item->product_variant)
              <a href="{{ $item->product_variant->product->url }}">
                <div class="text-primary">{!! $item->product_variant->product->name !!}</div>
              </a>
              @endif

              <div>
                <small>{{$item->status}}</small>
              </div>

              @if ($item->shipping_order)

              <div class="w-100">
                <div class="text-left got-medium text-sm"><small>Método de envío:</small></div>
                <div class="text-sm">{{$item->shipping_order->provider ?? 'Desconocido'}}</div>
                <a href="{{$item->getTrackingUrl()}}" class="btn btn-primary btn-sm my-2">Trackear</a>
              </div>
              @endif

            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="btn col-2">
      @switch($order->status->slug)
      @case('pending')

      <a href="{{url('/pay/' . $order->id)}}" class='btn btn-primary btn-sm float-left'>
        <i class="fas fa-redo"></i> Reintentar pago
      </a>

      @break

      {{-- @case('paid')

      <form action="{{ url('/pay/' . $order->id) }}" method="POST">
      @csrf
      <div>
        <button class='btn btn-primary btn-sm'>
          <i class=""></i><small>Generar factura</small>
        </button>
      </div>
      </form>
      @break --}}

      @case('billing')
      No has completado tus datos de facturación, presiona el botón para generar tu factura
      <a href="{{url('/bill/' . $order->id)}}" class='btn btn-primary btn-sm'>
        <i class="fas fa-receipt"></i><small> Generar factura</small>
      </a>
      @break

      {{-- @case('shipping')
      <a href="{{url('/ship/' . $order->id)}}" class='btn btn-primary btn-sm float-left'><i class=""></i>Generar orden
      de
      envío</a>
      @break --}}

      @case ('delivery')
      <br>
      <div class="mt-4">

        <form action="{{ url('/account/orders/' . $order->id . '/status') }}" method="POST">
          @csrf
          <div>
            <input type="hidden" name="status_slug" value="completed">
            <button class='btn btn-success btn-sm float-left'>
              <i class="fas fa-check"></i>
              <small>
                Marcar como recibido
              </small>
            </button>
          </div>
        </form>
      </div>
      @break

      @endswitch

      @if ($order->canAskRefund())
      <br>
      <div class="mt-4">
        <button data-toggle="modal" data-target="#refundModal_{{$order->id}}" class='btn btn-danger btn-sm float-left'
          onclick="initializeSelect2()">
          <i class="fas fa-reply"></i><small> Devolver</small>
        </button>

        @section('scripts')
        <script>
          function initializeSelect2() {
            $('select.select2').select2();
          }

        </script>
        @endsection

      </div>
      @endif


      <!-- Refund Modal-->
      <div class="modal fade modal-bg modal-body-bg-gradient offer-24-card" id="refundModal_{{$order->id}}"
        tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content px-4">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button class="close text-right mt-3" type="button" data-dismiss="modal" aria-label="Close">
              <i class="far fa-times-circle text-white"></i>
              <span aria-hidden="true"></span>
            </button>

            <div class="h2 col-lg-12 text-center mt-1 mb-2">Formulario de devoluciones</div>

            <div class="modal-body mb-3">
              <form id="refund-form" action="{{ url('/account/orders/refund/' . $order->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group col-lg-12 text-sm text-left">
                  <label for="name">Nombre y Apellido</label>
                  <input type="text" name="name" id="name" class="form-control text-white" placeholder="">
                </div>

                <div class="form-group col-lg-12 text-sm text-left">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control text-white" placeholder="">
                </div>

                <div class="form-group col-lg-12 text-sm text-left">
                  <label for="phone">Teléfono</label>
                  <input type="text" name="phone" id="phone" class="form-control text-white" placeholder="">
                </div>

                <div class="form-group col-lg-12 text-sm text-left">
                  <label for="order_id">Número de pedido</label>
                  <input type="text" name="order_id" id="order_id" class="form-control text-white" placeholder="">
                </div>

                <div class="form-group col-lg-12 text-sm text-left">
                  <label for="date">Fecha de la compra</label>
                  <date-selector label="Fecha de la compra" class="w-100 text-white" field-name="date">
                  </date-selector>
                </div>


                <div class="form-group col-lg-12 text-sm text-left select2-transparent">
                  <label for="reason">Motivo</label>
                  <select class="form-control text-white select2" name="reason" id="reason" required>
                    <option class="text-primary">Color</option>
                    <option class="text-primary">Talla</option>
                    <option class="text-primary">Calidad descrita</option>
                  </select>
                </div>

                <div class="form-group col-lg-12 text-sm text-left">
                  <label for="message">Descripción</label>
                  <textarea class="form-control text-white" name="message" id="message" rows="3" required></textarea>
                </div>


                <button type="submit" class="btn btn-white btn-flat btn-block font-weight-bold col-lg-12">
                  Enviar
                </button>





              </form>


            </div>



          </div>
        </div>
      </div>


    </div>
  </div>
</div>


{{-- <!-- Total Price Field -->
<div class="form-group col-6">
  {!! Form::label('total_price', 'TOTAL:') !!}
  <p>${!! $order->total_price !!}</p>
</div>

@if ($order->notes)
<!-- Notes Field -->
<div class="form-group col-12">
  {!! Form::label('notes', 'Notas:') !!}
  <p>{!! $order->notes !!}</p>
</div>
@endif



@if ($order->coupon)
<!-- Coupon Id Field -->
<div class="form-group col-12">
  {!! Form::label('coupon_id', 'Cupón:') !!}
  <p>{!! $order->coupon->name !!}</p>
</div>
@endif --}}
