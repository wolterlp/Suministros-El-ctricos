@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Clientes</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('clientes.create') }}" class="btn btn-primary mb-3">Registrar Nuevo Cliente</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cédula</th>
                <th>Razón Social</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->cedula }}</td>
                    <td>{{ $cliente->razon_social }}</td>
                    <td>
                        <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info">
                            <div class="icon-container">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
                                    <path d="M 5 5 C 2.25 5 0 7.25 0 10 L 0 39 C 0 41.75 2.25 44 5 44 L 21 44 C 22.664063 44 24 45.351563 24 47 C 24 47.308594 24.144531 47.601563 24.386719 47.789063 C 24.632813 47.980469 24.949219 48.046875 25.25 47.96875 C 25.511719 47.902344 25.738281 47.734375 25.875 47.5 C 25.960938 47.347656 26.003906 47.175781 26 47 C 26 45.351563 27.335938 44 29 44 L 45 44 C 47.75 44 50 41.75 50 39 L 50 10 C 50 7.25 47.75 5 45 5 L 29 5 C 27.367188 5 25.914063 5.8125 25 7.03125 C 24.085938 5.8125 22.632813 5 21 5 Z M 5 7 L 21 7 C 22.667969 7 24 8.332031 24 10 L 24 43.125 C 23.152344 42.464844 22.148438 42 21 42 L 5 42 C 3.332031 42 2 40.667969 2 39 L 2 10 C 2 8.332031 3.332031 7 5 7 Z M 29 7 L 45 7 C 46.667969 7 48 8.332031 48 10 L 48 39 C 48 40.667969 46.667969 42 45 42 L 29 42 C 27.851563 42 26.847656 42.464844 26 43.125 L 26 10 C 26 8.332031 27.332031 7 29 7 Z"></path>
                                </svg>
                            </div>
                        </a>



                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">
                            <div class="icon-container">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 26 26">
                                    <path d="M 20.09375 0.25 C 19.5 0.246094 18.917969 0.457031 18.46875 0.90625 L 17.46875 1.9375 L 24.0625 8.5625 L 25.0625 7.53125 C 25.964844 6.628906 25.972656 5.164063 25.0625 4.25 L 21.75 0.9375 C 21.292969 0.480469 20.6875 0.253906 20.09375 0.25 Z M 16.34375 2.84375 L 14.78125 4.34375 L 21.65625 11.21875 L 23.25 9.75 Z M 13.78125 5.4375 L 2.96875 16.15625 C 2.71875 16.285156 2.539063 16.511719 2.46875 16.78125 L 0.15625 24.625 C 0.0507813 24.96875 0.144531 25.347656 0.398438 25.601563 C 0.652344 25.855469 1.03125 25.949219 1.375 25.84375 L 9.21875 23.53125 C 9.582031 23.476563 9.882813 23.222656 10 22.875 L 20.65625 12.3125 L 19.1875 10.84375 L 8.25 21.8125 L 3.84375 23.09375 L 2.90625 22.15625 L 4.25 17.5625 L 15.09375 6.75 Z M 16.15625 7.84375 L 5.1875 18.84375 L 6.78125 19.1875 L 7 20.65625 L 18 9.6875 Z"></path>
                                </svg>
                            </div>
                        </a>
                        <!-- Aquí puedes agregar un formulario para eliminar el cliente -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
