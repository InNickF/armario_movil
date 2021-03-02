@component('mail::message')
# Atención

Hola {{$user->full_name}}, 

Se ha solicitado la devolución de un pedido


Nombre: {{$input['name']}}

Email: {{$input['email']}}

Telefóno: {{$input['phone']}}

ID del pedido: #{{$input['order_id']}}

Fecha de compra: #{{$input['date']}}


{{-- 
Valor del pedido (subtotal): ${{$order->subtotal}}

IVA: ${{$order->vat_price}}

Valor de envío: ${{$order->total_shipping_price}}

TOTAL: ${{$order->total_price}} --}}


Motivo seleccionado: {{$input['reason'] ?? '?'}}

Explicación: {{$input['message'] ?? '?'}}
{{-- 
# Productos en este pedido
<ul>
    @foreach ($order->items as $item)
    <li>{{$item->quantity}} {{$item->product_variant->product->name}} (ID: {{$item->product_variant->product->id}}) - Tienda #{{$item->product_variant->product->store_id}}</li>
    @endforeach
</ul> --}}

@component('mail::button', ['url' => url('/admin/coupons/create')])
Crear cupón
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
