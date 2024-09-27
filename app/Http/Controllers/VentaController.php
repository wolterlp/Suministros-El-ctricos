<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleVenta;  
use App\Models\Producto;  
use App\Models\Venta;  
use App\Models\Cliente;
use App\Models\Factura;

class VentaController extends Controller
{
    //
    public function index()
    {
        // Obtener todas las ventas de la base de datos
        //$ventas = Venta::all(); // Puedes usar paginate() para paginación si lo prefieres //OLD
        $ventas = Venta::with('cliente')->orderBy('created_at', 'desc')->get();
        // Retornar la vista con las ventas
        return view('ventas.index', compact('ventas'));
    }


    public function create()
    {
            // Obtener la lista de productos y clientes para usarlos en el formulario
            $productos = Producto::all(); // Suponiendo que tienes un modelo Producto
            $clientes = Cliente::all(); // Suponiendo que tienes un modelo Cliente

            // Retornar la vista con los datos necesarios
            return view('ventas.create', compact('productos', 'clientes'));
    }

    public function store(Request $request)
    {
 
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',  // Cambiado 'id' a 'producto_id'
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);
        
        $total = 0;
    
        foreach ($validated['productos'] as $productoVenta) {
            $producto = Producto::find($productoVenta['producto_id']);
            $subtotal = $producto->precio * $productoVenta['cantidad'];
            $total += $subtotal;
        }
   
        $iva = $total * 0.19;
        $totalConIva = $total + $iva;
 
        $venta = Venta::create([
            'cliente_id' => $validated['cliente_id'],
            'total' => $total,
            'iva' => $iva,
            'total_con_iva' => $totalConIva,
        ]);
          
        foreach ($validated['productos'] as $productoVenta) {
           $detalleVenta = DetalleVenta::create([
                'venta_id' => $venta->id,
                'producto_id' => $productoVenta['producto_id'],
                'cantidad' => $productoVenta['cantidad'],
                'precio_unitario' => Producto::find($productoVenta['producto_id'])->precio,
                'subtotal' => Producto::find($productoVenta['producto_id'])->precio * $productoVenta['cantidad'],
            ]);
           
        }
    
         // Generar número de factura único
        $ultimoNumeroFactura = Factura::max('numero_factura');
        $nuevoNumeroFactura = $ultimoNumeroFactura ? $ultimoNumeroFactura + 1 : 1001; // Puedes empezar desde el número que prefieras

         // Generar la factura
        $factura = Factura::create([
            'numero_factura' => $nuevoNumeroFactura,
            'venta_id' => $venta->id,
            'cliente_id' => $validated['cliente_id'],
            'total_factura' => $totalConIva, // Total de la venta el que queda en la factua
        ]);
       
        return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente');
    }
    
    public function destroy($id)
    {
        // Buscar la venta por ID
        $venta = Venta::findOrFail($id);

        // Eliminar los detalles de la venta asociados
        $venta->detalleVentas()->delete(); // Asumiendo que existe una relación 'detalleVentas'

        // Eliminar la factura asociada, si existe
        $factura = Factura::where('venta_id', $venta->id)->first();
        if ($factura) {
            $factura->delete();
        }

        // Eliminar la venta
        $venta->delete();

        // Redirigir o retornar una respuesta
        return redirect()->route('ventas.index')->with('success', 'La venta ha sido eliminada correctamente.');
    }


}
