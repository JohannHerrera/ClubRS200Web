@extends('layouts.app')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    Listado de Pilotos
                </div>
                <div class="col-md-4">
                    <form id="buscarPiloto" action="{{ route('pilotos.index') }}" method="get">
                        <div class="d-flex justify-content-center">
                            <div class="form-group col">
                                <input id="buscar"  placeholder="Ingrese Nombre, Placa o Nick" type="text" class="form-control" placeholder="Buscar Piloto..." autofocus/>
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
                            @if(Auth::user()->roles->isadmin)
                            <th>Acciones</th>
                            @endif
                            <th>Avatar</th>
                            <th>No. Placa</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Apodo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pilotos as $piloto)
                            <tr>
                                @if(Auth::user()->roles->isadmin)
                                    <td>
                                        <a href="{{ route('pilotos.perfil', ['id'=>$piloto->id]) }}" class="btn btn-primary btn-sm">Editar</a>
                                        <a href="{{ route('pilotos.eliminar', ['id'=>$piloto->id]) }}" class="btn btn-danger btn-sm">Eliminar</a>
                                    </td>
                                @endif

                                <td class="py-1">
                                    <img src="{{ route('user.avatar', ['filename'=>$piloto->image]) }}" alt="Avatar">
                                </td>
                                <td>{{ $piloto->defaultmotorbike }}</td>
                                <td>{{ $piloto->name.' '.$piloto->surname }}</td>
                                <td>{{ $piloto->email }}</td>
                                <td>{{ $piloto->nick }}</td>
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
