@extends('layouts.app')

@section('content')
<div class="card">
        <div class="card-header">Editar Piloto</div>
        <div class="card-body">
            <form method="POST" action="{{ route('pilotos.cambiarperfil') }}" enctype="multipart/form-data" aria-label="Configuración de mi cuenta">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">

                <div class="row">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h4 class="card-title">Información Básica</h4>

                                    <div class="form-group row">
                                        <label for="identificationtype_id" class="col-md-4 col-form-label text-md-right">{{ __('Tipo Identificación') }}</label>
                                        <div class="col-md-6">
                                           <input id="identificationtype_id" type="text" class="form-control font-weight-bold" name="identificationtype_id" value="{{ isset($user->identificationTypes) ? $user->identificationTypes->description : '' }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="identification" class="col-md-4 col-form-label text-md-right">{{ __('Identificación') }}</label>
                                        <div class="col-md-6">
                                            <input id="identification" type="text" class="form-control font-weight-bold" name="identification" value="{{ $user->identification }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nick" class="col-md-4 col-form-label text-md-right">{{ __('Nick') }}</label>
                                        <div class="col-md-6">
                                            <input id="nick" type="text" class="form-control font-weight-bold" name="nick" value="{{ $user->nick }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control font-weight-bold" name="name" value="{{ $user->name.' '.$user->surname }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control font-weight-bold" name="email" value="{{ $user->email }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="defaultmotorbike" class="col-md-4 col-form-label text-md-right">{{ __('Placa') }}</label>
                                        <div class="col-md-6">
                                            <input id="defaultmotorbike" type="text" class="form-control font-weight-bold" name="defaultmotorbike" value="{{ $user->defaultmotorbike }}" disabled>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="rol_id" class="col-md-4 col-form-label text-md-right">{{ __('Perfil') }}</label>
                                        <div class="col-md-6">
                                            <select id="rol_id" name="rol_id" class="form-control" required autofocus>
                                                <option value="">:: SELECCIONE ::</option>
                                                @foreach($roles as $rol)
                                                    <option value="{{ $rol->id }}" {{ ($user->rol_id == $rol->id) ? 'selected' : '' }}>{{ $rol->description }}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('rol_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('rol_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-body">
                                <h4 class="card-title">Información Complementaria</h4>

                                <div class="form-group row">
                                    <label for="bloodgroup_id" class="col-md-4 col-form-label text-md-right">{{ __('Grupo Sanguíneo') }}</label>
                                    <div class="col-md-6">
                                        <input id="bloodgroup_id" type="text" class="form-control font-weight-bold" name="bloodgroup_id" value="{{ isset($user->bloodGroups) ? $user->bloodGroups->description : '' }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="mobilenumber" class="col-md-4 col-form-label text-md-right">{{ __('No. Celular') }}</label>
                                    <div class="col-md-6">
                                        <input id="mobilenumber" type="text" class="form-control font-weight-bold" name="mobilenumber" value="{{ $user->mobilenumber }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="emergencycontactname" class="col-md-4 col-form-label text-md-right">{{ __('Contacto Emergencia') }}</label>
                                    <div class="col-md-6">
                                        <input id="emergencycontactname" type="text" class="form-control font-weight-bold" name="emergencycontactname" value="{{ $user->emergencycontactname }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="emergencycontactnumber" class="col-md-4 col-form-label text-md-right">{{ __('Celular Emergencia') }}</label>
                                    <div class="col-md-6">
                                        <input id="emergencycontactnumber" type="text" class="form-control font-weight-bold" name="emergencycontactnumber" value="{{ $user->emergencycontactnumber }}" disabled>
                                    </div>
                                </div>


                                <div class="form-group row">
                                        <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('Fecha Nacimiento') }}</label>
                                        <div class="col-md-6">
                                            <input id="birthday" type="text" class="form-control font-weight-bold" name="birthday" value="{{ $user->birthday }}" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                            <label for="isorgandonor" class="col-md-4 col-form-label text-md-right">{{ __('Es Donador') }}</label>
                                            <div class="col-md-6">
                                                <input id="isorgandonor" type="text" class="form-control font-weight-bold" name="isorgandonor" value="{{ $user->isorgandonor == 1 ? 'SI' : 'NO' }}" disabled>
                                            </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="rol_id" class="col-md-4 col-form-label text-md-right"> {{ __('Estado') }}</label>
                                        <div class="col-md-6">
                                            <div class="form-check form-check-flat">
                                                <label class="form-check-label">
                                                    <input id="isactive" name="isactive" type="checkbox" class="form-check-input"  data-id="{{$user->isactive}}" {{ $user->isactive ? 'checked' : '' }}> Activo / Inactivo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="template-demo">
                            <button type="submit" class="btn btn-primary btn-fw">
                                    Actualizar
                            </button>
                            <a href="{{ route('pilotos.index') }}" class="btn btn-danger btn-fw">Cancelar</a>
                        </div>
                    </div>
            </form>
        </div>
</div>





@endsection
