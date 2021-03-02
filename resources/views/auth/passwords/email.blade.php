@extends('layouts.auth')

@section('content')




<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-8 mx-auto">

            <div class="login-card card d-block mx-auto p-2">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-12">
                            <div class="p-3">
                                <div class="text-center mb-5">
                                    <div class=" mb-4 text-uppercase">Recuperación de contraseña</div>
                                    <div class="h4">Ingresa tu Email para recuperar tu contraseña</div>
                                </div>


                                @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                                @endif


                                <form id="recuperacion" class="mb-5" method="post" action="{{ url('/password/email') }}">
                                    {!! csrf_field() !!}

                                    <div class="form-group mx-auto has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email">Dirección de correo electrónico</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                            placeholder="">
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif 
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-light btn-user">Recuperar contraseña</button>
                                    </div>
                                </form>

                                <div class="text-center mb-3">
                                    <div class=" my-4 ">Al ingresar tu correo electrónico vinculada a tu cuenta de Armario Móvil te enviaremos un mensaje para que puedas recuperar tu contraseña.</div>
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
