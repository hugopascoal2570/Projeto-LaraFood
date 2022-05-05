@extends('adminlte::page')

@section('title', "Detalhes da Permissão { $permissions->name }")

@section('content_header')
    <h1>Detalhes do plano{{ $permissions->name }}</h1>

@stop

@section('content')
    @include('admin.includes.alerts')
    <div class="card">
        <div class="car-body">
            <ul>
                <li>
                    <strong>Nome: </strong>{{ $permissions->name }}
                </li>
                <li>
                    <strong>Descrição: </strong>{{ $permissions->description }}
                </li>
            </ul>
        </div>

    </div>
    <form action="{{ route('permissions.destroy', ['permission' => $permissions->id]) }}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger">Deletar o {{ $permissions->name }}</button>
    </form>
@stop
