<div class="d-flex">
    <a href="https://www.facebook.com/sharer/sharer.php?u={!! url()->current() !!}" onclick="ga('send', 'event', 'Producto', 'Compartir', 'Facebook', {{$product->id}});" target="_blank">
      <img src="{{asset('/images/icons/single-product/facebook-icon-small-grey.png')}}" alt="" class="mx-2">
    </a>
<a href="https://pinterest.com/pin/create/button/?url={!! $product->main_image !!}&media={!! $product->main_image !!}&description={!! $product->name !!}" onclick="ga('send', 'event', 'Producto', 'Compartir', 'Pinterest', {{$product->id}});" target="_blank">
      <img src="{{asset('/images/icons/single-product/pinterest-icon-small-grey.png')}}" alt="" class="mx-2">
    </a>
  </div>