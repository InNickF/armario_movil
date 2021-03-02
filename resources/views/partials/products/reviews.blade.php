    <div class="element-wrapper">

        <div class="element-box">
            <div class="container">
                <div class="box box-primary">
                    <div class="box-body">


                        <div class="os-tabs-w">
                            <div class="os-tabs-controls">
                                <ul class="nav nav-tabs bigger">
                                    <li class="nav-item">
                                        <a class="nav-link active show" data-toggle="tab" href="#tab_orders">
                                            Reviews
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tab_orders">
                                    <div class="table-responsive">

                                        @include('partials.reviews-table', ['item' => $product])
                                        {{--<a href="{{url('/reviews?productId=' . $product->id)}}" class="btn btn-primary">All Product Reviews</a>--}}
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>


                </div>
            </div>
        </div>
    </div>
