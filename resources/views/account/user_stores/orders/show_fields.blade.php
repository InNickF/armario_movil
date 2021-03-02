@php
$user = auth()->user();
@endphp


  <!-- Status Id Field -->

  <div class="row">
    <div class="col-lg-4 col-sm-4">
      <div class="row">
        <div class="col-6 pl-2">
          <div class="text-primary font-weight-boldest"><small>Enviado a:</small></div>
          <p><small>{!! $order->shipping_address ? $order->shipping_address->full_address : 'Dirección no encontrada' !!}</small></p>
        </div>

        <div class="col-6 pl-1">
          <div class="text-primary font-weight-boldest"><small>Estado:</div>
          <p>{!! $order->status->name !!}</small></p>
        </div>


        @if ($order->billing_document_id)
        <div class="col-6 pl-2">
          <div class="text-primary font-weight-boldest"><small>Nº de factura:</div>
          <p>{{$order->billing_document_id}}</small></p>
        </div>
        @endif
      </div>
    </div>

    <div class="col-lg-4 col-sm-4">
      <div class="text-primary font-weight-bold"><small>Items del pedido:</small></div>
      <div class="row">
        <div class="col-12">
          @foreach($order->getItemsByStore($user->store->id) as $item)
          <div class="d-flex align-items-center">

            <div class="mr-2 text-primary">{{ $item->quantity }}</div>
            <div class="img-fluid img-sm">
              <a href="{{ $item->product_variant->product->url }}">
                <div class="avatar-sm rounded-circle mr-3 my-3 bg-center bg-cover"
                  style="background-image:url('{{ $item->product_variant->product->main_image }}')"></div>
            </div>
            </a>
            <div>
                @if ($item->product_variant)
              <a href="{{ $item->product_variant->product->url }}">
                <div class="text-primary"><small>{!! $item->product_variant->product->name !!}</small></div>
              </a>
              @endif

              <div>
                  <small>{{$item->status}}</small>
                </div>

                @if ($item->shipping_order)
              <div class="w-100">
                <div class="text-left got-medium text-sm">Método de envío:</div>
                <p class="text-sm">{{$item->shipping_order->provider ?? 'Desconocido'}}</p>
                <a href="{{$item->getTrackingUrl()}}" class="btn btn-primary btn-sm mb-3">Trackear</a>
              </div>
              @endif

            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="col-sm-4 col-lg-4 pl-1">

      <div class="row">
        <div class="col-12">
          <button data-toggle="modal" data-target="#uploadBillModal_{{$order->id}}"
            class='btn btn-primary btn-sm float-left mt-2 mt-md-0'>
            <i class="font-weight-boldest"></i><small>Subir factura</small>
          </button>

        </div>
        @if (!empty($order->getBillDocuments($user->store->id)))
        <div class="row mt-4">
          <div class="col-12">
            <h5>Facturas subidas</h5>
            <ul>
              @foreach ($order->getBillDocuments($user->store->id) as $bill)
              <li>
                <a href="{{$bill->getFullUrl()}}" target="_blank">{{$bill->created_at}}</a>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
        @endif
      </div>

      <!-- Bill Modal-->
      <div class="modal-bg">

        <div class="modal fade" id="uploadBillModal_{{$order->id}}" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content bg-grey-gradient border-0">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>

              <div class="modal-body rounded text-primary px-5">

                <div class="h2 text-center">Datos de facturación de Armario Móvil</div>
                <div class="text-center"><small>Confirma que los datos de tu factura coincidan con esta información
                    antes de subir el
                    archivo.</small></div>



                <div class="row d-flex align-items-center mt-4">
                  <div class="col-3 text-primary text-right text-sm font-weight-boldest">
                    <p class="font-weight-boldest mb-0">Nombre:</p>
                  </div>
                  <div class="col-9 text-primary text-left">
                    <p class="mb-0"><small>Armario Móvil S.A</small></p>
                  </div>
                </div>

                <div class="row d-flex align-items-center">
                  <div class="col-3 text-primary text-right text-sm font-weight-boldest">
                    <p class="font-weight-boldest mb-0">RUC:</p>
                  </div>
                  <div class="col-9 text-primary text-left">
                    <p class="mb-0"><small>1792963737001</small></p>
                  </div>
                </div>

                <div class="row d-flex align-items-center">
                  <div class="col-3 text-primary text-right text-sm font-weight-boldest">
                    <p class="font-weight-boldest mb-0">Dirección:</p>
                  </div>
                  <div class="col-9 text-primary text-left">
                    <p class="mb-0"><small>Juan Lagos S11-77 y Pedro Capiro</small></p>
                  </div>
                </div>

                <div class="row d-flex align-items-center">
                  <div class="col-3 text-primary text-right text-sm font-weight-boldest">
                    <p class="font-weight-boldest mb-0">Teléfono:</p>
                  </div>
                  <div class="col-9 text-primary text-left">
                    <p class="mb-0"><small>022 652 229</small></p>
                  </div>
                </div>

                <div class="row d-flex align-items-center">
                  <div class="col-3 text-primary text-right text-sm font-weight-boldest">
                    <p class="font-weight-boldest mb-0">Email:</p>
                  </div>
                  <div class="col-9 text-primary text-left">
                    <p class="mb-0"><small>facturas@armariomovil.com</small></p>
                  </div>
                </div>

                <div class="row d-flex align-items-center">
                  <div class="col-3 text-primary text-right text-sm font-weight-boldest">
                    <p class="font-weight-boldest mb-0">Fecha:</p>
                  </div>
                  <div class="col-9 text-primary text-left">
                    <p class="mb-0"><small>Fecha en la que fue realizada la venta</small></p>
                  </div>
                </div>

                <div class="row d-flex align-items-center">
                  <div class="col-3 text-primary text-right text-sm font-weight-boldest">
                    <p class="font-weight-boldest mb-0">Detalle:</p>
                  </div>
                  <div class="col-9 text-primary text-left">
                    <p class="mb-0"><small>Descripción del producto o los productos vendidos.</small></p>
                  </div>
                </div>

                <div class="row d-flex align-items-center">
                  <div class="col-3 text-primary text-right text-sm font-weight-boldest">
                    <p class="font-weight-boldest mb-0">Valor:</p>
                  </div>
                  <div class="col-9 text-primary text-left">
                    <p class="mb-0"><small>Precio global por el cual fue vendido el producto (incluido comisiones e
                        impuestos)</small></p>
                  </div>
                </div>

              </div>



              <form id="refund-form" action="{{ url('/account/orders/'.$order->id.'/add_bill') }}" method="POST"
                enctype="multipart/form-data" class="bg-transparent mb-2">
                {{ csrf_field() }}

                <upload-single-document ref="uploadBillRef" title="Subir factura" class="btn-cambiar-foto btn-sm"
                  field-name="bill_file" old-image="">
                </upload-single-document>
                <input type="hidden" name="store_id" value="{{$user->store->id}}">
                <div class="d-flex justify-content-center">
                  <button class="btn btn-outline-transparent btn-sm text-sm font-weight-boldest text-primary"
                    type="submit">Subir factura</button>
                </div>
              </form>
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
