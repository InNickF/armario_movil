@extends('layouts.account')


@section('title')
    Seguridad
@endsection

@section('content')

<div class="container-fluid">

    <!-- Outer Row -->
    <div class="row justify-content-start">

        <div class="col-xl-6 col-lg-8 col-md-9 mx-auto">

            <div class="card o-hidden border-0 shadow-sm my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="px-5 py-4 password-form">
                                <div class="d-flex justify-content-start align-items-center mb-3">
                                    <img src="{{url('/images/icons/key-icon.svg')}}" class="icon-sm mr-2" alt="">
                                    <h1 class="h4 text-primary mb-0">Cambio de contraseña</h1>
                                </div>
                                @include('flash::message')
                                <form method="post" action="{{ url('/account/password') }}">
                                    {!! csrf_field() !!}

                                    <div class="form-group has-feedback{{ $errors->has('old_password') ? ' has-error' : '' }}">
                                        <div class="text-primary font-weight-bold mb-1">Contraseña actual:</div>
                                        <input type="password" class="form-control text-sm input-password" name="old_password" placeholder="Contraseña actual" data-toggle="password">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                                        @if ($errors->has('old_password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <div class="text-primary font-weight-bold mb-1">Nueva contraseña:</div>
                                        <input type="password" class="form-control text-sm input-password" name="password" placeholder="Nueva contraseña" data-toggle="password">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                        <div class="text-sm text-primary"><small>Tu contraseña nueva debe tener:</small></div>
                                        <ul class="text-sm text-primary pl-3"><small>
                                        <li>Mínimo 8 caracteres</li>
                                        <li>Letras en mayúsculas y minúsuclas</li>
                                        <li>Debe incluir un mínimo de 2 números y 1 caracter especial</li>
                                    </small>
                                    </ul>

                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                            <div class="text-primary font-weight-bold mb-1">Repite la contraseña:</div>
                                        <input type="password" name="password_confirmation" class="form-control text-sm text-secondary  input-password"
                                            placeholder="Repite la nueva contraseña" data-toggle="password">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                                        @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block no-hover font-weight-bold mt-4">Guardar cambios</button>
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
