<?php

namespace App\Http\Controllers;
use App\Models\Cliente;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los clientes de la base de datos
        $clientes = Cliente::all(); // Puedes usar paginate() para paginación si lo prefieres

        // Retornar la vista con los clientes
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retornar la vista de creación de cliente
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:clientes',
            'razon_social' => 'required|string|max:255',
        ]);

        // Creación del nuevo cliente
        $cliente = Cliente::create([
            'nombre' => $request->nombre,
            'cedula' => $request->cedula,
            'razon_social' => $request->razon_social,
        ]);

        // Redirigir a la lista de clientes con un mensaje de éxito
        return redirect()->route('clientes.index')->with('success', 'Cliente registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::findOrFail($id); // Buscar el cliente por ID
        return view('clientes.show', compact('cliente')); // Retornar la vista con el cliente
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id); // Buscar el cliente por ID
        return view('clientes.edit', compact('cliente')); // Retornar la vista de edición con el cliente
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:clientes,cedula,' . $id,
            'razon_social' => 'required|string|max:255',
        ]);
    
        $cliente = Cliente::findOrFail($id); // Buscar el cliente por ID
        $cliente->update([
            'nombre' => $request->nombre,
            'cedula' => $request->cedula,
            'razon_social' => $request->razon_social,
        ]);
    
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.'); // Redirigir con mensaje de éxito
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id); // Buscar el cliente por ID
        $cliente->delete(); // Eliminar el cliente
    
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.'); // Redirigir con mensaje de éxito
    }
}
