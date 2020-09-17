@extends('layouts.app')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    Listado de Convenios
                </div>
                <div class="col-md-4">
                    <form id="buscarConvenio" action="{{ route('agreement.index') }}" method="get">
                        <div class="d-flex justify-content-center">
                            <div class="form-group col">
                                <input id="buscar"  placeholder="Ingrese Nombre" type="text" class="form-control" autofocus/>
                            </div>
                            <div class="form-group col">
                                <input type="submit" value="Buscar" class="btn btn-dark">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pilotos as $piloto)
                            <tr>
                                <td class="py-1">
                                    <img src="{{ route('user.avatar', ['filename'=>$piloto->image]) }}" alt="Avatar">
                                </td>
                                <td>{{ $piloto->name.' '.$piloto->surname }}</td>
                                <td>{{ $piloto->email }}</td>
                                <td>
                                    <label class="badge {{ $piloto->isactive ? 'badge-success' : 'badge-danger' }}">{{ $piloto->isactive ? 'Activar' : 'Desactivar' }}</label>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- Paginacion --}}
                {{ $pilotos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
