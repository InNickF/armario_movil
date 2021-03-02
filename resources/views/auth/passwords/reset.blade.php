@extends('layouts.auth')

@section('content')



    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-8 mx-auto"> 

                <div class="login-card card o-hidden border-0 shadow-lg mt-5 bg-gradient-transparent">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-12">
                                <div class="p-5">
                                    <div class="text-center mb-5">
                                        <h1 class="h4 mb-4 text-uppercase">Recuperación de contraseña</h1>
                                        <div class="h4">Establece tu nueva contraseña</div>
                                    </div> 

                                    <form method="post" action="{{ url('/password/reset') }}">
                                        {!! csrf_field() !!}

                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                                            <input type="email" class="form-control" name="email"
                                                   value="{{ old('email') }}"
                                                   placeholder="Email">
                                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                            @endif
                                        </div>

                                        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <input type="password" class="form-control" name="password"
                                                   placeholder="Contraseña" data-toggle="password">
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
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-light btn-user">Recuperar
                                                contraseña
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


@endsection
