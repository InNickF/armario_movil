@extends('layouts.app-front')

@section('content-bottom')


<div class="container">
    <div class="row">

    <div class="col-12 my-4 text-primary">
        <h3 class="text-center">Resultados para la búsqueda:</h3>
        <h3 class="font-weight-bold text-center">"{{$search}}"</h3>
    </div>

    <div class="col-12 text-center">

        <h4 class="mb-2 text-primary">Productos</h4>
        <div class="row mb-4">
            @forelse ($products as $product)
            <div class="col-sm-6 col-lg-3 col-sm-12 mb-4">
                <div class="card">
                <product-card :product="{{json_encode($product)}}">
                    </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>No se han encontrado resultados</p>
            </div>
            @endforelse
        </div>

        <h4 class="mb-2 text-primary">Tiendas</h4>
        <div class="row mb-4">
            @forelse ($stores as $store)
            <div class="col-lg-4 col-sm-6 col-sm-12">
                @include('partials.stores.store-card')
            </div>
            @empty
            <div class="col-12 text-center">
                <p>No se han encontrado resultados</p>
            </div>
            @endforelse
        </div>

    </div>

</div>
</div>

@endsection
