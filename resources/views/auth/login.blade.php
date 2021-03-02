@extends('layouts.auth')



@section('content')

<div class="content-login">


  <div class="container-fluid p-0">

    <!-- Outer Row -->
    <div class="row justify-content-center w-100 m-0">

      <div class="col-12 mx-auto">

        <div class="login-card card d-block mx-auto p-2">
          <div class="card-body p-0">


            <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link nav-nuevo {{request()->has('register') ? 'active' : ''}}" id="profile-tab" href="{{url('/login?register')}}" role="tab"
                  aria-controls="register" aria-selected="false">¿Nuevo en Armario?</a>
              </li>

              <li class="nav-item">
              <a class="nav-link nav-registrado {{!request()->has('register') ? 'active' : ''}}" id="home-tab" href="{{url('/login')}}" role="tab"
                  aria-controls="login" aria-selected="true">Ya estoy registrado</a>
              </li>
              
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade {{!request()->has('register') ? 'show active' : ''}}" id="login" role="tabpanel" aria-labelledby="home-tab">

                <div class="row">
                  {{-- <div class="col-lg-6 d-none d-lg-block"></div> --}}
                  <div class="col-lg-12">
                    <div class="p-5">

                      <div class="text-center">
                        <h1 class="h4 mb-4">Ingresa con Email</h1>
                      </div>
                      <form method="post" action="{{ url('/login') }}">
                        {!! csrf_field() !!}

                        <div class="form-group mx-auto has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                          <label for="email">Dirección de correo electrónico</label>
                          <input type="email" class="form-control text-white" name="email" value="{{ old('email') }}"
                            placeholder="" required>
                          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                          @if ($errors->has('email'))
                          <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                          </span>
                          @endif
                        </div>

                        <div class="form-group mx-auto has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password">Contraseña</label>
                          <input type="password" class="form-control text-white" placeholder=""
                            name="password" required data-toggle="password">
                          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                          @if ($errors->has('password'))
                          <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                          </span>
                          @endif

                          {{-- <div class="form-group">
                                                            <div class="custom-control custom-checkbox small d-flex align-items-center">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                                <label class="custom-control-label" for="customCheck">Recordarme</label>
                                                            </div>
                                                        </div> --}}

                        </div>
                        <div class="text-center">
                          <button type="submit" class="btn btn-light btn-md btn-user">
                            Iniciar sesión
                          </button>
                        </div>


                      </form>

                      <div class="text-center">
                        <a class="small text-white underline" href="{{ url('/password/reset') }}">Olvidé la
                          contraseña</a><br>
                      </div>

                    </div>


                    <div class="text-center">
                      <h1 class="h4 mb-4 px-2">También puedes ingresar con</h1>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center mb-5 px-3">
                      <a href="{{url('login/facebook')}}" class="btn btn-redes btn-user mb-2 w-sm-100 mr-0 mr-md-3">
                        <i class="fab fa-facebook-f fa-fw"></i> Facebook
                      </a>
                      <a href="{{url('login/google')}}" class="btn btn-redes btn-user mb-2 w-sm-100 ml-0 mr-md-3">
                        <i class="fab fa-google fa-fw mt-0"></i> Google
                      </a>
                    </div>



                  </div>
                </div>


              </div>
              <div class="tab-pane fade {{request()->has('register') ? 'show active' : ''}}" id="register" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">
                  {{-- <div class="col-lg-6 d-none d-lg-block"></div> --}}
                  <div class="col-lg-12">
                    <div class="p-5">
                      <div class="text-center">
                        <h1 class="h4 mb-4">Regístrate con...</h1>
                      </div>
                      <div class="d-flex flex-wrap justify-content-center mb-5">
                        <a href="{{url('login/facebook')}}" class="btn btn-redes btn-user mr-0 mr-md-3 w-sm-100">
                          <i class="fab fa-facebook-f fa-fw"></i> Facebook
                        </a>
                        <a href="{{url('login/google')}}" class="btn btn-redes btn-user ml-0 ml-md-3 mt-2 mt-md-0 w-sm-100">
                          <i class="fab fa-google fa-fw mt-0"></i> Google
                        </a>
                      </div>

                      <div class="text-center mt-3">Registrarte con tu Facebook o Gmail es
                        súper rápido,
                        no te preocupes, no hay contraseñas extras que recordar
                        y nunca compartiremos ninguno de tus datos ni publicaremos nada a tu
                        nombre.
                      </div>
                      <div class="text-center h4 h4 mt-4">
                        <p class="mb-0">ó</p>
                        <p class="mt-1">Ingresar usando tu dirección de correo
                          electrónico</p>
                      </div>

                      <form method="post" action="{{ url('/register') }}">
                        {!! csrf_field() !!}


                        <div class="form-group has-feedback{{ $errors->has('first_name') ? ' has-error' : '' }}">
                          <label for="name">Nombre</label>
                          <input type="text" class="form-control text-white" name="first_name" value="{{ old('first_name') }}"
                            placeholder="" required>
                          <span class="glyphicon glyphicon-user form-control-feedback"></span>

                          @if ($errors->has('first_name'))
                          <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                          </span>
                          @endif
                        </div> 

                        <div class="form-group has-feedback{{ $errors->has('last_name') ? ' has-error' : '' }}">
                          <label for="name">Apellido</label>
                          <input type="text" class="form-control text-white" name="last_name" value="{{ old('last_name') }}"
                            placeholder="" required>
                          <span class="glyphicon glyphicon-user form-control-feedback"></span>

                          @if ($errors->has('last_name'))
                          <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                          </span>
                          @endif
                        </div> 

                        <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label for="email">Dirección de correo electrónico</label>
                          <input type="email" class="form-control text-white" name="email" value="{{ old('email') }}"
                            placeholder="" required>
                          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                          @if ($errors->has('email'))
                          <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                          </span>
                          @endif
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password">Contraseña</label>
                          <input type="password" class="form-control text-white" name="password"
                            placeholder="" required data-toggle="password">
                          <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                          @if ($errors->has('password'))
                          <span class="help-block">
                            <strong>
                              {{ $errors->first('password') }}
                            </strong>
                          </span>
                          @endif
                        </div>

                        <div
                          class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                          <label for="password_confirmation">Repite la contraseña</label>
                          <input type="password" name="password_confirmation" class="form-control text-white"
                            placeholder="" required data-toggle="password">
                          <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                          @if ($errors->has('password_confirmation'))
                          <span class="help-block">
                            <strong>
                              {{ $errors->first('password_confirmation') }}
                            </strong>
                          </span>
                          @endif
                        </div>


                        <div class="form-group mt-4">
                          <div class="checkbox icheck">
                            <label>
                              <input onclick="$('#registerSubmitBtn').attr('disabled', !$(this).is(':checked'));" type="checkbox" required> Aceptar <a class="text-white underline" href="#" data-toggle="modal" data-target="#termsModal">términos y condiciones</a> de {{setting('app_name', 'Armario Móvil')}}
                            </label>
                          </div>

                            </div>

                            <div class="text-center">
                              <button id="registerSubmitBtn" type="submit" class="btn btn-light btn-lg btn-user" disabled>
                                Registrarse
                              </button>
                            </div>

                      </form>


                    </div>
                  </div>
                </div>
              </div>
            </div>


            <!-- Nested Row within Card Body -->

          </div>
        </div>

      </div>

    </div>

  </div>
</div>
</div>
</div>


@endsection
