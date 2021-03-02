<div class="d-flex star-rating-sm">

  @if ($store->rating && $store->rating > 1)
    @foreach (range(1, $store->rating) as $i => $star)
    <img src="{{$theme == 'light' ? asset('/images/rating/bag-'.($star).'.png') : asset('/images/rating/bag-white.png') }}" alt="" class="mx-1">
    @endforeach

  @else
  <img src="{{$theme == 'light' ? asset('/images/rating/bag-1.png') :  asset('/images/rating/bag-white.png') }}" alt="" class="mx-1">
  @endif

</div>
