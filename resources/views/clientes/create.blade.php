@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Nuevo Cliente</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container mx-auto px-4">
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="nombre">Nombre</label>
                <input style="width: 97%" type="text" name="nombre" id="nombre" class="form-control w-1/2" required>
            </div>

            <div class="form-group mb-3">
                <label for="cedula">Cédula</label>
                <input style="width: 97%" type="text" name="cedula" id="cedula" class="form-control w-1/2" required>
            </div>

            <div class="form-group mb-3">
                <label for="razon_social">Razón Social</label>
                <input style="width: 97%" type="text" name="razon_social" id="razon_social" class="form-control w-1/2" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar Cliente</button>
        </form>
    </div>

</div>

@endsection
