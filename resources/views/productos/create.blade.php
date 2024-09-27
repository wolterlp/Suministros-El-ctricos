<!-- resources/views/productos/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Crear Producto</h1>

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <form action="{{ route('productos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre_producto">Nombre del Producto:</label>
                <input style="width: 97%" type="text" name="nombre_producto" id="nombre_producto" class="form-control" value="{{ old('nombre_producto') }}" required>
            </div>

            <div class="form-group">
                <label for="codigo_producto">Código del Producto:</label>
                <input style="width: 97%" type="text" name="codigo_producto" id="codigo_producto" class="form-control" value="{{ old('codigo_producto') }}" required>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input style="width: 97%" type="number" name="precio" id="precio" class="form-control" value="{{ old('precio') }}" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="stock">Stock:</label>
                <input style="width: 97%" type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}" required>
            </div>

            <div class="form-group">
                <label for="estado">Estado:</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="en stock" {{ old('estado') == 'en stock' ? 'selected' : '' }}>En Stock</option>
                    <option value="agotado" {{ old('estado') == 'agotado' ? 'selected' : '' }}>Agotado</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Crear Producto</button>
        </form>
    </div>
@endsection
