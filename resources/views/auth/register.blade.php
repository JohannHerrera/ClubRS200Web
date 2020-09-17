<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset('/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/vendors/css/vendor.bundle.base.css') }}">
        <link rel="stylesheet" href="{{ asset('/vendors/css/vendor.bundle.addons.css') }}">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
        <!-- endinject -->
        <link rel="shortcut icon" href="{{ asset('/images/LogoClubRS200.png') }}">
    </head>

    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
                <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
                    <div class="row w-100">
                        <div class="col-lg-4 mx-auto">
                            <h2 class="text-center mb-4">{{ __('Register') }}</h2>
                            <div class="auto-form-wrapper">
                                <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input id="identification" type="text" placeholder="Identificación" class="form-control{{ $errors->has('identification') ? ' is-invalid' : '' }}" name="identification" value="{{ old('identification') }}" required autofocus>
                                            @if ($errors->has('identification'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('identification') }}</strong>
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
                                            <input id="name" type="text" placeholder="Nombres" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  required autofocus>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
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
                                            <input id="surname" type="text" placeholder="Apellidos" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}"  required >
                                            @if ($errors->has('surname'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('surname') }}</strong>
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
                                            <input id="nick" type="text" placeholder="Apodo" class="form-control{{ $errors->has('nick') ? ' is-invalid' : '' }}" name="nick" value="{{ old('nick') }}" required autofocus>

                                            @if ($errors->has('nick'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nick') }}</strong>
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
                                            <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
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
                                            <input id="defaultmotorbike" type="text" placeholder="Placa" class="form-control{{ $errors->has('defaultmotorbike') ? ' is-invalid' : '' }}" name="defaultmotorbike" value="{{ old('defaultmotorbike') }}" style="text-transform:uppercase;" required autofocus>
                                            @if ($errors->has('defaultmotorbike'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('defaultmotorbike') }}</strong>
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


                                    <div class="form-group">
                                        <button class="btn btn-primary submit-btn btn-block">{{ __('Register') }}</button>
                                    </div>

                                    <div class="text-block text-center my-3">
                                        <a href="/" class="text-black text-small" >{{ __('Login') }}</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="{{ asset('/vendors/js/vendor.bundle.base.js') }}"></script>
        <script src="{{ asset('/vendors/js/vendor.bundle.addons.js') }}"></script>
        <!-- endinject -->
        <!-- inject:js -->
        <script src="{{ asset('/js/off-canvas.js') }}"></script>
        <script src="{{ asset('/js/misc.js') }}"></script>
        <!-- endinject -->
    </body>

</html>
