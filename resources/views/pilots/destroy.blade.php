@extends('layouts.app')

@section('content')
<div class="card">
        <div class="card-header">Eliminar Piloto</div>
        <div class="card-body">
            <form aria-label="Configuración de mi cuenta">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $user->id }}">

                <div class="form-group row">
                    <label for="identificationtype_id" class="col-md-4 col-form-label text-md-right">{{ __('Tipo Identificación') }}</label>
                    <div class="col-md-6">
                        <input id="identificationtype_id" type="text" class="form-control" name="identificationtype_id" value="{{ $user->identificationTypes->description }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="identification" class="col-md-4 col-form-label text-md-right">{{ __('Identificación') }}</label>
                    <div class="col-md-6">
                        <input id="identification" type="text" class="form-control" name="identification" value="{{ $user->identification }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nick" class="col-md-4 col-form-label text-md-right">{{ __('Nick') }}</label>
                    <div class="col-md-6">
                        <input id="nick" type="text" class="form-control" name="nick" value="{{ $user->nick }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>
                    <div class="col-md-6">
                        <input id="surname" type="text" class="form-control" name="surname" value="{{ $user->surname }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="defaultmotorbike" class="col-md-4 col-form-label text-md-right">{{ __('Placa') }}</label>
                    <div class="col-md-6">
                        <input id="defaultmotorbike" type="text" class="form-control" name="defaultmotorbike" value="{{ $user->defaultmotorbike }}" disabled>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#eliminarpiloto">
                            Eliminar
                        </button>
                        <div class="modal" id="eliminarpiloto">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">¿Estas seguro de querer eliminarlo?</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    Si eliminas este piloto no podrás recuperarlo.
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('pilotos.destroy', ['id' => $user->id]) }}" class="btn btn-danger  btn-sm">Eliminar definitivamente</a>
                                    <button type="button" class="btn btn-outline-dark  btn-sm" data-dismiss="modal">Cancelar</button>
                                </div>

                                </div>
                            </div>
                        </div>

                        <a href="{{ route('pilotos.index') }}" class="btn btn-outline-dark btn-sm">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
</div>





@endsection
