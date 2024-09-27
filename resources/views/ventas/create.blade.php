@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Nueva Venta</h1>

    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf

        <!-- Selección del cliente -->
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-select" required>
                <option value="">Seleccione un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Detalles de la venta -->
        <h3>Detalles de la Venta</h3>
        <div id="detalle-ventas">
            <div class="mb-3 detalle">
                <label for="producto_id" class="form-label">Producto</label>
                <select name="productos[0][producto_id]" class="form-select" required>
                    <option value="">Seleccione un producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre_producto }}</option>
                    @endforeach
                </select>

                <label for="cantidad" class="form-label">Cantidad</label>
                <input style="width: 97%" type="number" name="productos[0][cantidad]" class="form-control margen-elemento" min="1" required>

                <button type="button" class="btn btn-danger mt-2 remove-detalle margen-elemento ">Eliminar</button>
       
            </div>
        </div>

        <!-- Botones de acción -->
        <button type="button" id="add-detalle" class="btn btn-primary">Agregar Producto</button>
        <button type="submit" class="btn btn-success mt-4">Registrar Venta</button>
    
    </form>
</div>

<script>
    let detalleIndex = 1; // Para mantener el índice de los detalles

    document.getElementById('add-detalle').addEventListener('click', function() {
        const detalleVentas = document.getElementById('detalle-ventas');
        
        const newProductField = `
            <div class="mb-3 detalle">
                <label for="producto_id" class="form-label">Producto</label>
                <select name="productos[${detalleIndex}][producto_id]" class="form-select" required>
                    <option value="">Seleccione un producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre_producto }}</option>
                    @endforeach
                </select>

                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" name="productos[${detalleIndex}][cantidad]" class="form-control margen-elemento" min="1" required>

                <button type="button" class="btn btn-danger mt-2 remove-detalle margen-elemento ">Eliminar</button>
            </div>`;
        
        detalleVentas.insertAdjacentHTML('beforeend', newProductField);
        detalleIndex++;
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-detalle')) {
            event.target.closest('.detalle').remove();
        }
    });
</script>

@endsection
