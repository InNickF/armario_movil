@extends('layouts.account')



@section('title')
    Pagos y cobros
@endsection

@section('content')

<div class="content mt-4 container-fluid">
  <div class="clearfix"></div>
  @include('flash::message')
  @include('adminlte-templates::common.errors')
  <nav class="mt-3">
    <div class="nav" id="nav-tab" role="tablist">
      <a class="{{ request()->has('tab') ? request()->tab == 'paying' ? 'active' : '' : 'active' }} btn btn-outline-primary btn-sm mr-1 mb-1 font-weight-bold px-3" id="address-buy-tab" data-toggle="tab" href="#paying"
        role="tab">
        Métodos de pago
      </a>
      <a class="{{ request()->has('tab') ? request()->tab == 'collecting' ? 'active' : '' : '' }} btn btn-outline-primary mr-1 mb-1 btn-sm font-weight-bold px-3" id="address-sell-tab" data-toggle="tab" href="#collecting" role="tab">
        Métodos de cobro
      </a>
    </div>
  </nav>
  <div class="clearfix"></div>
  <div class="tab-content" id="updateAddressesApp">
    <div class="tab-pane fade {{ request()->has('tab') ? request()->tab == 'paying' ? 'show active' : '' : 'show active' }}" id="paying" role="tabpanel" aria-labelledby="addresses-buy-tab">
      <div class="col-12">
        <div class="row">
          <div class="col-lg-6 col-sm-12 mt-4">
              <h4 class="mb-4 text-left text-primary h3">Métodos de pago</h4>
            <user-cards-list></user-cards-list>
          </div>
          <div class="col-lg-6 col-sm-12 mt-4">
            <h4 class="mb-4 text-left text-primary h3">Agregar nueva tarjeta</h4>
            <form id="add-card-form" class="card o-hidden shadow-sm">
              <div id="my-card" data-capture-name="true" class="paymentez-form card-body" data-icon-colour="#3490dc">
                <input class="card-number form-control">
                <input id="userNameField" class="name form-control">
                <input class="expiry-month form-control">
                <input class="expiry-year form-control">
              </div>
              <div class="px-3 text-center"><button id="payOrderAddCardButton" class="btn btn-primary">Agregar
                  tarjeta</button></div>
              <br />
              <div class="text-center text-primary" id="messages"></div>
            </form>
          </div>
        </div>
      </div>  
      <input type="hidden" id="userIdField" value="{{$user->id}}">
      <input type="hidden" id="userEmailField" value="{{$user->email}}">
    </div>
    <div class="tab-pane fade {{ request()->has('tab') ? request()->tab == 'collecting' ? 'show active' : '' : '' }}" id="collecting" role="tabpanel" aria-labelledby="addresses-sell-tab">

      <div class="container p-0 p-md-3">
        <div class="row">
  
          <div class="col-lg-12 col-sm-12 mx-auto mt-4">
            <div class="card o-hidden border-0 shadow-sm my-3">
              <div class="px-md-5 px-1 py-4">
                <div class="d-flex justify-content-start align-items-center mb-0 ml-3">
                  <div>
                    <img src="{{url('/images/icons/hand-coin-icon.svg')}}" class="icon-sm mr-2" alt="">
                  </div>
                    <h1 class="h4 text-primary mb-0 text-left">Editar método de cobro</h1>
                </div>
            <form method="POST" action="{{url('/account/collecting_method')}}">
              @csrf
                <div class="card-body row">
                    @if ($user->collecting_method && $user->collecting_method->bank->logo)
                    <div class="col-12 text-left mb-2">
                      <img class="img-sm" src="{{$user->collecting_method->bank->logo}}" alt="">
                    </div>
                    @endif

                    <div class="form-group col-sm-6 text-primary mb-4">
                        {!! Form::label('person_type', 'Tipo de persona:') !!}
                        {!! Form::select('person_type', ['Natural' => 'Natural', 'Jurídica' => 'Jurídica'], $user->collecting_method ? $user->collecting_method->person_type : null, ['placeholder' => 'Selecciona...', 'class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="form-group col-sm-6 text-primary mb-4">
                        {!! Form::label('document_type', 'Tipo de documento:') !!}
                        {!! Form::select('document_type', ['Cédula' => 'Cédula', 'RUC' => 'RUC', 'Pasaporte' => 'Pasaporte'], $user->collecting_method ? $user->collecting_method->document_type : null, ['placeholder' => 'Selecciona...', 'class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="form-group col-sm-6 text-primary mb-4">
                        <label for="document_number">Número de documento:</label>
                        {!! Form::text('document_number', $user->collecting_method ? $user->collecting_method->document_number : null, ['class' => 'form-control', 'required']) !!}
                      </div>

                      <div class="form-group col-sm-6 text-primary mb-4">
                          <label for="name">Nombre del titular:</label>
                          {!! Form::text('name', $user->collecting_method ? $user->collecting_method->name : null, ['class' => 'form-control', 'required']) !!}
                        </div>

               
                  <div class="form-group col-sm-6 text-primary mb-4">
                      {!! Form::label('bank_id', 'Banco:') !!}
                      {!! Form::select('bank_id', App\Models\Bank::pluck('name', 'id')->toArray(), $user->collecting_method && $user->collecting_method->bank ? $user->collecting_method->bank->id : null, ['placeholder' => 'Seleccionar banco', 'class' => 'form-control', 'required']) !!}
                  </div>

                  <div class="form-group col-sm-6 text-primary mb-4">
                      {!! Form::label('account_type', 'Tipo de cuenta:') !!}
                      {!! Form::select('account_type', ['Ahorros' => 'Ahorros', 'Corriente' => 'Corriente'], $user->collecting_method ? $user->collecting_method->account_type : null, ['placeholder' => 'Selecciona...', 'class' => 'form-control', 'required']) !!}
                  </div>

                  <div class="form-group col-sm-6 text-primary mb-4">
                    <label for="account_number">Número de cuenta:</label>
                    {!! Form::text('account_number', $user->collecting_method ? $user->collecting_method->account_number : null, ['class' => 'form-control', 'required']) !!}
                  </div>


                  <div class="form-group col-sm-6 text-primary mb-4">
                      <label for="email">Correo electrónico:</label>
                      {!! Form::email('email', $user->collecting_method ? $user->collecting_method->email : null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="form-group col-sm-6 text-primary mb-4">
                        <label for="account_number">Teléfono:</label>
                        {!! Form::text('phone', $user->collecting_method ? $user->collecting_method->phone : null, ['class' => 'form-control', 'required', 'pattern' => '\+?[0-9 ]+', 'maxlength' => '10', 'minlength' => '10']) !!}
                      </div>


                  <div class="px-3 text-center col-12">
                    <button class="btn btn-primary btn-block font-weight-bold">Guardar método de cobro
                    </button>
                  </div>
                  <br />
                  <div class="text-center text-primary" id="messages"></div>
                </div>
              </form>
            </div>
          </div>
          </div>
        </div>
      </div>


    </div>
  </div>
  <div class="text-center">
  </div>
</div>
@endsection



@section('scripts')
@parent
<script src="{{ asset('js/paymentez-add-card.js') }}"></script>
@stop
