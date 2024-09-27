@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registro de Ventas</h1>
    <a href="{{ route('ventas.create') }}" class="btn btn-primary">Nueva Venta</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>IVA</th>
                <th>Total con IVA</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
            <tr>
                <td>{{ $venta->id }}</td>
                <td>{{ $venta->cliente->nombre }}</td>
                <td>${{ number_format( $venta->total , 0, ',', '.') }}</td>
                <td>${{ number_format($venta->iva, 0, ',', '.') }}</td> 
                <td>${{ number_format($venta->total_con_iva, 0, ',', '.') }}</td>
                <td>{{ $venta->created_at }}</td>
                <td>
                    <a href="{{ route('facturas.generar', $venta->id) }}" class="btn btn-info">
                        <div class="icon-container">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2">
                                <rect x="3" y="7" width="18" height="10" rx="2" ry="2"></rect>
                                <path d="M8 7V3h8v4"></path>
                                <path d="M8 17h8v4H8v-4"></path>
                                <path d="M18 10h.01"></path>
                            </svg>
                        </div>
                    </a>
                    <form action="{{ route('ventas.destroy', $venta) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <div class="icon-container">
                                <svg stroke="red" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 24 24">
                                    <path d="M 10 2 L 9 3 L 4 3 L 4 5 L 5 5 L 5 20 C 5 20.522222 5.1913289 21.05461 5.5683594 21.431641 C 5.9453899 21.808671 6.4777778 22 7 22 L 17 22 C 17.522222 22 18.05461 21.808671 18.431641 21.431641 C 18.808671 21.05461 19 20.522222 19 20 L 19 5 L 20 5 L 20 3 L 15 3 L 14 2 L 10 2 z M 7 5 L 17 5 L 17 20 L 7 20 L 7 5 z M 9 7 L 9 18 L 11 18 L 11 7 L 9 7 z M 13 7 L 13 18 L 15 18 L 15 7 L 13 7 z"></path>
                                </svg>
                            </div>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
