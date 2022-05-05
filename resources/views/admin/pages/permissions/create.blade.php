@extends('adminlte::page')

@section('title', 'Cadastrar novo Plano')

@section('content_header')
    <h1>Cadastrar nova Permissão</h1>

@stop

@section('content')

    <div class="card">
        <div class="car-body">
            <form action="{{ route('permissions.store') }}" method="POST" class="form">
                @include('admin.pages.profiles._partials.form')
            </form>
        </div>
    </div>
@stop
