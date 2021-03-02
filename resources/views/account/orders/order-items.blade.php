<div>
  
  <div class="container">
    <div class="row">
      @forelse ($order_items as $order_item)
      <div class="col-lg-4 col-md-6 my-3">
        @include('partials.order-items.order-item-card', ['order_item' => $order_item])
      </div>
      @empty
      <div class="w-100 my-5 py-5 text-primary">
                  <p>No se han encontrado productos</p>
                  </div>
      @endforelse
    </div>
    {{$order_items->links()}}

  </div>
</div>
