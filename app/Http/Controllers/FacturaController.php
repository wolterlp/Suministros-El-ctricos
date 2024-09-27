<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;  
use App\Models\Producto;  
use App\Models\Venta;  
use App\Models\Cliente;
use App\Models\Factura;

use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function generarFactura($id)
    {
       
    // Buscar la venta por ID
    $venta = Venta::with('cliente', 'detalleVentas.producto')->findOrFail($id);

    // Calcular el total de la factura
    $totalFactura = $venta->total_con_iva; // Asegúrate de que este campo exista en tu modelo Venta

    // Generar un nuevo número de factura
    $ultimoNumeroFactura = Factura::max('numero_factura');
    $nuevoNumeroFactura = $ultimoNumeroFactura ? $ultimoNumeroFactura + 1 : 1001; // Cambia el número inicial según tu lógica

    // Crear la factura
    $factura = Factura::create([
        'numero_factura' => $nuevoNumeroFactura,
        'venta_id' => $venta->id,
        'cliente_id' => $venta->cliente_id,
        'total_factura' => $totalFactura,
    ]);

    // Redirigir a la vista de la factura
    return view('facturas.show', compact('factura', 'venta','totalFactura'));

    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $factura = Factura::with('venta.cliente', 'venta.detalleVentas.producto')->findOrFail($id);
        return view('facturas.show', compact('factura'));
    }

}
