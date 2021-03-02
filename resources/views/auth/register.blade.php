@extends('layouts.auth')

@section('content')



<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Regístrate</h1>
                                </div>
                                <form method="post" action="{{ url('/register') }}">
                                    {!! csrf_field() !!}



                                    <div class="form-group has-feedback{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}"
                                            placeholder="Nombre">
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>

                                        @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group has-feedback{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"
                                            placeholder="Apellido">
                                        <span class="glyphicon glyphicon-user form-control-feedback"></span>

                                        @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                            placeholder="Email">
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input type="password" class="form-control" name="password" placeholder="Contraseña" data-toggle="password">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="Confirmar contraseña" data-toggle="password">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                                        @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox icheck">
                                            <label>
                                                <input type="checkbox"> I agree to the <a href="#">terms</a>
                                            </label>
                                        </div>

                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">Crear cuenta</button>

                                    <hr>
                                    <a href="index.html" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i> Login con Google
                                    </a>
                                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                        <i class="fab fa-facebook-f fa-fw"></i> Login con Facebook
                                    </a>


                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ url('/password/reset') }}">Olvidé la contraseña</a><br>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ url('/login') }}">Ya tengo una cuenta</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
