@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Gentes</h1>

            <form id="buscador" action="{{ route('user.index') }}" method="get">
                <div class="row">
                    <div class="form-group col">
                        <input id="buscar" type="text" class="form-control">
                    </div>
                    <div class="form-group col">
                        <input type="submit" value="Buscar" class="btn btn-success">
                    </div>
                </div>
            </form>

            <hr>
            @foreach ($users as $user)
                <div class="profile-user">
                    @if ($user->image)
                        <div class="container-avatar">
                            <img src="{{ route('user.avatar', ['filename'=>$user->image]) }}" alt="Avatar" class="avatar">
                        </div>
                    @endif

                    <div class="profile-info">
                        <h2>{{ '@'.$user->nick }}</h2>
                        <h3>{{ $user->name.' '.$user->surname }}</h3>
                        <span class="nickname">{{ 'Se unió: '.\FormatTime::LongTimeFilter($user->created_at) }} </span>
                        <br/>
                        <a href="{{ route('profile', ['id' => $user->id]) }}" class="btn btn-sm btn-success">Visitar perfil</a>
                    </div>

                    <div class="clearfix"></div>
                    <hr>
                </div>
                <div class="clearfix"></div>
            @endforeach

            {{-- Paginacion --}}
            <div class="clearfix"></div>
            {{ $users->links() }}

        </div>
    </div>
</div>
@endsection
