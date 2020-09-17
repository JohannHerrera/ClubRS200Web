@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Crear Usuario Convenio, Líder o Piloto</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.create') }}" enctype="multipart/form-data"
                        aria-label="Creación de cuenta">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h4 class="card-title">Información Básica</h4>

                                    <div class="form-group">
                                        <label for="identificationtype_id">{{ __('Tipo Identificación') }}</label>
                                        <select id="identificationtype_id" name="identificationtype_id"
                                            class="form-control" required autofocus>
                                            <option value>:: SELECCIONE ::</option>
                                            @foreach($listIdentificationTypes as $identificationType)
                                            <option value="{{ $identificationType->id }}">
                                                {{ $identificationType->description }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('identificationtype_id'))
                                        <span class="help-block">
                                            <strong>
                                                {{ $errors->first('identificationtype_id') }}
                                            </strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="identification">Identificación</label>
                                        <input id="identification" type="text"
                                            class="form-control{{ $errors->has('identification') ? ' is-invalid' : '' }}"
                                            name="identification" value="" required autofocus>
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input id="name" type="text"
                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            name="name" value="" required autofocus>
                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="surname">{{ __('Surname') }}</label>
                                        <input id="surname" type="text"
                                            class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}"
                                            name="surname" value="" required autofocus>
                                        @if ($errors->has('surname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('surname') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="nick">{{ __('Nick') }}</label>
                                        <input id="nick" type="text"
                                            class="form-control{{ $errors->has('nick') ? ' is-invalid' : '' }}"
                                            name="nick" value="" required autofocus>
                                        @if ($errors->has('nick'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nick') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="email">{{ __('E-Mail Address') }}</label>
                                        <input id="email" type="email"
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email" value="" required>
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="defaultmotorbike">{{ __('Placa') }}</label>
                                        <input id="defaultmotorbike" type="text"
                                            class="form-control{{ $errors->has('defaultmotorbike') ? ' is-invalid' : '' }}"
                                            name="defaultmotorbike" value="" required>
                                        @if ($errors->has('defaultmotorbike'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>
                                                {{ $errors->first('defaultmotorbike') }}
                                            </strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group row">
                                        <label for="rol_id">{{ __('Perfil') }}</label>

                                        <select id="rol_id" name="rol_id" class="form-control" required autofocus>
                                            <option value="">:: SELECCIONE ::</option>
                                            @foreach($roles as $rol)
                                            @if($rol->id >= 3)
                                            <option value="{{ $rol->id }}">{{ $rol->description }}</option>
                                            @endif
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

                            <div class="col-md-6">
                                <div class="card-body">
                                    <h4 class="card-title">Información Complementaria</h4>

                                    <div class="form-group">
                                        <label for="bloodgroup_id">{{ __('Grupo Sanguíneo') }}</label>
                                        <select id="bloodgroup_id" name="bloodgroup_id" class="form-control" autofocus>
                                            <option value>:: SELECCIONE ::</option>
                                            @foreach($listBloodGroups as $bloodgroup)
                                            <option value="{{ $bloodgroup->id }}">{{ $bloodgroup->description }}
                                            </option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="mobilenumber">No. Celular</label>

                                        <input id="mobilenumber" type="number"
                                            class="form-control{{ $errors->has('mobilenumber') ? ' is-invalid' : '' }}"
                                            name="mobilenumber" value="" autofocus>
                                        @if ($errors->has('mobilenumber'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mobilenumber') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="emergencycontactname">{{ __('Contacto Emergencia') }}</label>

                                        <input id="emergencycontactname" type="text"
                                            class="form-control{{ $errors->has('emergencycontactname') ? ' is-invalid' : '' }}"
                                            name="emergencycontactname" value="" autofocus>
                                        @if ($errors->has('emergencycontactname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>
                                                {{ $errors->first('emergencycontactname') }}
                                            </strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="emergencycontactnumber">{{ __('Celular Emergencia') }}</label>

                                        <input id="emergencycontactnumber" type="number"
                                            class="form-control{{ $errors->has('emergencycontactnumber') ? ' is-invalid' : '' }}"
                                            name="emergencycontactnumber" value="" autofocus>
                                        @if ($errors->has('emergencycontactnumber'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>
                                                {{ $errors->first('emergencycontactnumber') }}
                                            </strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="birthday">{{ __('Fecha Cumpleaños') }}</label>

                                        <input id="birthday" type="date"
                                            class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"
                                            name="birthday" value="" placeholder="dd/mm/yyyy" autofocus>
                                        @if ($errors->has('birthday'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('birthday') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="rol_id">{{ __('Es Donador') }}</label>
                                        <div class="form-check form-check-flat">
                                            <label class="form-check-label">
                                                <input id="isorgandonor" name="isorgandonor" type="checkbox"
                                                    class="form-check-input" data-id=""> Si / No
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="image_path">{{ __('Avatar') }}</label>
                                        @include('includes.avatar')
                                        <input id="image_path" type="file"
                                            class="form-control{{ $errors->has('image_path') ? ' is-invalid' : '' }}"
                                            name="image_path">
                                        @if ($errors->has('image_path'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image_path') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-success">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
