@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Editar mi imagen</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('image.update') }}" enctype="multipart/form-data" aria-label="Actualizar imágen">
                        @csrf

                        <input type="hidden" name="image_id" value="{{ $image->id }}">

                        <div class="form-group row">
                            <label for="image_path" class="col-md-2 col-form-label text-md-right">Imágen</label>
                            <div class="col-md-10">
                                @if ($image->users->image)
                                    <img src="{{ route('image.file', ['filename'=>$image->image_path]) }}" class="avatar">
                                @endif

                                <input id="image_path" type="file" class="form-control{{ $errors->has('image_path') ? ' is-invalid' : '' }}" name="image_path" value="" autofocus></input>
                                @if ($errors->has('image_path'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image_path') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">Descripción</label>
                            <div class="col-md-10">
                                <textarea id="description" rows="10" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required autofocus>{{ $image->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-2">
                                <input type="submit" class="btn btn-primary" value="Actualizar imágen"></input>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
