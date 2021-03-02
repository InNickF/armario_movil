@extends('layouts.account')

@section('title')
Mi cuenta
@endsection


@section('content')


{{-- @include('flash::message') --}}
{{-- @include('adminlte-templates::common.errors') --}}

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-sm-12 col-md-12 col-lg-5">
      <div class="card border-0 shadow-sm my-3">
        <div class="card-body">
          <!-- Nested Row within Card Body -->
          <div class="row">

            <div class="col-12">
              {!! Form::model($user, ['route' => ['users.updateProfile'], 'method' => 'post',
              'files'=>'true']) !!}
              <div class="row">

                @include('account.users.fields')

              </div>
              {!! Form::close() !!}
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-7">
      <div class="card shadow-sm my-3 border-0">
        <div class="card-body">


          @if (!$user->store)
          {{-- Create Store Button --}}
          <div class="col-12 my-5 py-5">
            <p class="my-5"></p>
            <div class="py-5 text-center">
              <div class="pb-5 mb-5">
                <p class="my-5"></p>
                <img src="/images/icons/activate-store.png" alt="" class="img-md-2 mt-5">
                <p class="text-dark-blue-opacity h4 mt-4">¿Quieres vender tus productos?</p>
                <a class="btn btn-outline-primary btn-sm font-weight-bold mb-5"
                  href="{{url('/account/store/activate')}}" class="h4">Activar mi tienda</a>
                <p class="my-5"></p>
              </div>
            </div>
            <p class="my-3"></p>
          </div>
          @else
          <div class="col-12">
            {!! Form::model($user->store, ['route' => ['store.update', $user->store->id], 'method' => 'post', 'files'=>
            true]) !!}

            <div class="row">
              @include('account.user_stores.fields')
            </div>

            {!! Form::close() !!}

            {!! Form::open(['route' => ['account.stores.destroy', $user->store->id], 'method' => 'delete']) !!}

            <button type="submit" class="btn-delete-product m-2 position-absolute cursor-pointer"
              onclick="return confirm('¿Estás seguro que deseas borrar permanentemente tu tienda y todos sus datos asociados (incluyendo registros de productos, outfits, pedidos, historias)?')">
              <i class="fa fa-times"></i>
            </button>

            {!! Form::close() !!}

          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
