@extends('layouts.app')

@section('content')

<div class="container" id="factura">
    <h1>Detalles de la Factura</h1>

    <h3>Venta ID: {{ $venta->id }}</h3>
    <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
    <p><strong>Cliente:</strong> {{ $venta->cliente->cedula }}</p>
    <p><strong>Total:</strong> ${{ number_format($factura->total_factura, 2) }}</p>
    
    <h4>Detalles de los Productos</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venta->detalleVentas as $detalle)
            <tr>
                <td>{{ $detalle->producto_id }}</td>
                <td>{{ $detalle->producto->nombre_producto }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                <td>${{ number_format($detalle->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total de la Factura: ${{ number_format($totalFactura, 2) }}</h4>
    
    <button class="no-print btn btn-primary" onclick="imprimirFactura()">Imprimir Factura</button>
    <a href="{{ route('ventas.index') }}" class="no-print btn btn-secondary">Volver a Ventas</a>
</div>

<script>
    function imprimirFactura() {
        // Oculta los elementos que no deseas imprimir
        const elementosNoImprimir = document.querySelectorAll('.no-print');
        elementosNoImprimir.forEach(elemento => {
            elemento.style.display = 'none';
        });

        // Inicia la impresión
        window.print();

        // Muestra nuevamente los elementos después de la impresión
        elementosNoImprimir.forEach(elemento => {
            elemento.style.display = '';
        });
    }
</script>

@endsection
