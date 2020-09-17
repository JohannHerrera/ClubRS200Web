@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">

            {{-- Mostrar mensajes --}}
            @include('includes.message')

            <div class="card">
                <div class="card-header">Cambiar Contraseña</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.cambiar') }}" enctype="multipart/form-data" aria-label="Cambiar Contraseña">
                        @csrf

                        <div class="form-group">
                            <div class="input-group">
                                <input id="password" type="password"  placeholder="Contraseña (*)" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autofocus>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input id="password-confirm" type="password" placeholder="Confirmar Contraseña (*)" class="form-control" name="password_confirmation" required autofocus>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="text-block text-center my-3 text-primary">
                                <p>(*)Contraseña debe tener al menos una letra mayúscula / minúscula, un número y longitud mínima de 10 caracteres.</p>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Cambiar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

