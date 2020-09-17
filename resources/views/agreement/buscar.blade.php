@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Pilotos</h1>

            <form id="buscarPilotoConvenio" action="{{ route('agreement.buscarPiloto') }}" method="get">
                <div class="row">
                    <div class="form-group col">
                        <input id="buscarPiloto" placeholder="Ingrese Nombre, Placa o Nick" type="text" class="form-control">
                    </div>
                    <div class="form-group col">
                        <input type="submit" value="Buscar" class="btn btn-success">
                    </div>
                </div>
            </form>

            <hr>
            @foreach ($pilotos as $piloto)
                <div class="profile-user">
                    @if ($piloto->image)
                        <div class="container-avatar">
                            <img src="{{ route('user.avatar', ['filename'=>$piloto->image]) }}" alt="Avatar" class="avatar">
                        </div>
                    @endif
                    <div class="clearfix"></div>
                    <div class="profile-info">
                        <h4>{{ 'Placa: '.$piloto->defaultmotorbike }}</h4>
                        <h5>{{ 'Nick: @'.$piloto->nick }}</h5>
                        <h5>{{ 'Nombre: '.$piloto->name.' '.$piloto->surname }}</h5>
                        <h6>{{ 'Se unió: '.\FormatTime::LongTimeFilter($piloto->created_at) }}</h6>
                        <br/>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                </div>
                <div class="clearfix"></div>
                <br/>
            @endforeach

            {{-- Paginacion --}}
            <div class="clearfix"></div>
            {{ $pilotos->links() }}

        </div>
    </div>
</div>
@endsection
