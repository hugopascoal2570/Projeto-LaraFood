@extends('adminlte::page')

@section('title', "Editar o perfil: {$permission->name}")

@section('content_header')
    <h1>Editar o plano {{ $permission->name }}</h1>

@stop

@section('content')

    <div class="card">
        <div class="car-body">
            <form action="{{ route('permissions.update', ['permission' => $permission->id]) }}" method="POST"
                class="form">

                @method('PUT')
                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
    </div>
@stop
