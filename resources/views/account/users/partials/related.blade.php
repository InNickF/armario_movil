

<div class="element-wrapper">

    <div class="element-box">
        <div class="container">
            <div class="box box-primary">
                <div class="box-body">


                    <div class="os-tabs-w">
                        <div class="os-tabs-controls">
                            <ul class="nav nav-tabs bigger">
                                <li class="nav-item">
                                    <a class="nav-link active show" data-toggle="tab"
                                       href="#tab_orders">
                                        Last Orders
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab"
                                       href="#tab_wishlist">Wishlist</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab_orders">
                                <div class="table-responsive">

                                    <table class="table table-lightborder">
                                        <thead>
                                        <tr>
                                            <th>
                                                Id
                                            </th>

                                            <th>
                                                Products
                                            </th>
                                            <th class="text-center">
                                                Status
                                            </th>
                                            <th>
                                                Total
                                            </th>
                                            <th class="text-right">
                                                Date
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse ($user->orders->take(10) as $order)
                                            <tr>
                                                <td class="nowrap">
                                                    <a href="{{url('/orders/' . $order->id . '/edit')}}">
                                                        {{$order->id}}
                                                    </a>
                                                </td>

                                                <td>
                                                    <div class="cell-image-list">
                                                        @forelse ($order->product_variants->take(5) as $product)
                                                            @if (!empty($product->images[0]))
                                                                <a href="{{ $product->url}}">
                                                                    <div class="cell-img"
                                                                         style="background-image: url({{asset('storage/' . $product->images[0]->path) }})"></div>
                                                                </a>
                                                            @endif

                                                            @if(count($order->product_variants) > 5)
                                                                <div class="cell-img-more">
                                                                    {{count($order->product_variants) - 5}} more
                                                                </div>
                                                            @endif
                                                        @empty
                                                            No products
                                                        @endforelse
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="status-pill {{ $order->status['color'] }}"
                                                         data-title="{{ $order->status ? $order->status->getTranslation('name', 'en') : 'Not set' }}"
                                                         data-toggle="tooltip"></div>

                                                </td>
                                                <td class="nowrap">
                                                    ${{ $order->total_price }}
                                                </td>
                                                <td class="text-right">
                                                    {{$order->created_at}}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td><p> No results</p></td></tr>
                                        @endforelse

                                        </tbody>
                                    </table>


                                    <a href="{{url('/orders?userId=' . $user->id)}}"
                                       class="btn btn-primary">All Customer
                                        Orders</a>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_wishlist">
                                <div class="table-responsive">

                                        <table class="table table-lightborder">
                                            <thead>
                                            <tr>
                                                <th>
                                                    Id
                                                </th>

                                                <th>
                                                    Product
                                                </th>
                                                <th>
                                                    Image
                                                </th>
                                                <th class="text-right">
                                                    Date Added
                                                </th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse ($user->wishlist as $wishlist)
                                            <tr>
                                                <td class="nowrap">
                                                    <a href="{{url('products/' . $wishlist->id . '/edit')}}">
                                                        {{$wishlist->id}}
                                                    </a>
                                                </td>


                                                <td class="nowrap">
                                                    <a href="{{url('products/' . $wishlist->id . '/edit')}}">
                                                        {{$wishlist->title}}
                                                    </a>
                                                </td>

                                                <td>
                                                    <div class="cell-image-list">
                                                        @if (!empty($wishlist->images[0]))
                                                            <a href="{{url('/products/' . $wishlist->id . '/edit' )}}">
                                                                <div class="cell-img"
                                                                     style="background-image: url({{asset('storage/' . $wishlist->images[0]->path) }})"></div>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>

                                                <td class="text-right">
                                                    {{ $wishlist->created_at }}
                                                </td>
                                            </tr>
                                            @empty
                                                <tr><td><p>No results</p></td></tr>
                                            @endforelse
                                            </tbody>
                                        </table>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
        </div>
    </div>
</div>
