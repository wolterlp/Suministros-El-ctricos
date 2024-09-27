<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\DetalleVenta;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
         // Obtener todos los productos
         $productos = Producto::all();
        
         // Retornar la vista con los productos
         return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // Método para mostrar el formulario de creación
    public function create()
    {
        return view('productos.create');  // Retorna la vista 'productos/create'
    }

    // Método para almacenar el producto en la base de datos
    public function store(Request $request)
    {
        // Método para almacenar el producto en la base de datos
        if($request['stock'] <= 0){
            $estado='agotado';
        } else {
            $estado='en stock';
        }

        // Validación de los datos
        $validatedData = $request->validate([
            'nombre_producto' => 'required|string|max:255',
            'codigo_producto' => 'required|string|unique:productos|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'estado' => 'required|in:en stock,agotado',
        ]);

        // Añado manualmente el valor de 'estado' 
        $validatedData['estado'] = $estado;

        $producto = Producto::create($validatedData);

        // Redireccionar al listado de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito.');

    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Buscar el producto por su id
        $producto = Producto::findOrFail($id); // Esto arrojará un 404 si no se encuentra el producto
        // Retornar la vista de edición con los datos del producto
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $producto = Producto::findOrFail($id);

        // Validar los datos que vienen del formulario
        $validatedData = $request->validate([
            'nombre_producto' => 'required|string|max:255',
            'codigo_producto' => 'required|string|unique:productos,codigo_producto,' . $id, // Ignorar el producto actual
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'estado' => 'required|in:en stock,agotado',
        ]);

        // Actualizar los datos del producto con la información validada
        $producto->update($validatedData);

        // Redireccionar a la lista de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /*no se tiene encuenta si hay facturacion lo mejor es no eliminar del todo el
        producto solo se cambiaria de estado wolterlp*/ 
        
        // Buscar el producto por su ID
        $producto = Producto::findOrFail($id); // Esto arrojará un 404 si no se encuentra el producto

        // Eliminar el producto
        $producto->delete();

        // Redireccionar a la lista de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto eliminado con éxito.');

    }

    public function inventario()
    {
        // Obtén todos los productos
        $productos = Producto::all();

        // Mapeo para agregar disponibilidad y calcular la cantidad
        $inventarioProductos = $productos->map(function ($producto) {
            // Sumar la cantidad vendida del producto
            $cantidadVendida = DetalleVenta::where('producto_id', $producto->id)
                                            ->sum('cantidad');

            // Calcular la cantidad disponible en stock
            $cantidadDisponible = $producto->stock - $cantidadVendida; // Asumiendo que 'cantidad' es el stock del producto

            return [
                'id' => $producto->id,
                'nombre_producto' => $producto->nombre_producto,
                'stock' => $cantidadDisponible,
                'disponibilidad' => $cantidadDisponible > 0 ? 'En stock' : 'Agotado',
            ];
        });

        // Retornar vista con la lista de productos y su disponibilidad
        return view('productos.inventario', compact('inventarioProductos'));
    }

    public function agregarStock($id, $cantidad)
    {
        $producto = Producto::findOrFail($id);
        $producto->stock += $cantidad; // Aumentar el stock
        $producto->save();
        
    
        return redirect()->route('inventario.index')->with('success', 'Stock agregado exitosamente.');
    }

}
