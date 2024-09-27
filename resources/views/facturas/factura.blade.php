<!DOCTYPE html>
<html>
<head>
    <title>Factura</title>
    <style>
        /* Agrega estilos para la factura */
        body {
            font-family: Arial, sans-serif;
        }
        .factura {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="factura">
        <h1>Factura #{{ $venta->id }}</h1>
        <p>Cliente: {{ $venta->cliente->nombre }}</p>
        <p>Fecha: {{ $venta->created_at }}</p>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venta->detalleVentas as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre_producto }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ $detalle->precio_unitario }}</td>
                    <td>{{ $detalle->subtotal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p>Total: {{ $venta->total }}</p>
        <p>IVA: {{ $venta->iva }}</p>
        <p>Total con IVA: {{ $venta->total_con_iva }}</p>
    </div>
</body>
</html>
