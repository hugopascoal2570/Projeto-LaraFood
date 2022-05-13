@extends('adminlte::page')

@section('title', "Detalhes do usero { $user->name }")

@section('content_header')
    <h1>Detalhes do usuário{{ $user->name }}</h1>

@stop

@section('content')
    @include('admin.includes.alerts')
    <div class="card">
        <div class="car-body">
            <ul>
                <li>
                    <strong>Nome: </strong>{{ $user->name }}
                </li>
                <li>
                    <strong>email: </strong>{{ $user->url }}
                </li>
                <li>
                    <strong>Empresa: </strong>{{ $user->tenant->name }}
                </li>
            </ul>
        </div>

    </div>
    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger">Deletar o {{ $user->name }}</button>
    </form>
@stop
