@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Cliente</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nombre: {{ $cliente->nombre }}</h5>
            <p class="card-text">Cédula: {{ $cliente->cedula }}</p>
            <p class="card-text">Razón Social: {{ $cliente->razon_social }}</p>
        </div>
    </div>

    <a href="{{ route('clientes.index') }}" class="btn btn-secondary mt-3">Volver a la lista de Clientes</a>
</div>
@endsection
