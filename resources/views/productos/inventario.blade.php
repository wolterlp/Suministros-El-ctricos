@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Inventario de Productos</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Código del Producto</th>
                <th>Nombre del Producto</th>
                <th>Disponibilidad</th>
                <th>Cantidad en Stock</th>
                <th>Acciones</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($inventarioProductos as $producto)
                <tr>
                    <td>{{ $producto['id'] }}</td>
                    <td>{{ $producto['nombre_producto'] }}</td>
                    <td>{{ $producto['disponibilidad'] }}</td>
                    <td>{{ $producto['stock'] }}</td> 
                    <td>
                        <!-- Botón para agregar stock -->
                        <button class="btn btn-success" onclick="agregarStock({{ $producto['id'] }})">Agregar Stock</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function agregarStock(productoId) {
        const cantidad = prompt("Ingrese la cantidad de stock a agregar:");
        if (cantidad !== null && !isNaN(cantidad) && cantidad > 0) {
            // ruta para agregar stock
            window.location.href = `/productos/${productoId}/agregar-stock/${cantidad}`;
        } else {
            alert("Por favor, ingrese una cantidad válida.");
        }
    }
</script>
@endsection
