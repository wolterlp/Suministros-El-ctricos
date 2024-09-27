<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    // Definir la tabla asociada (opcional si la tabla se llama 'ventas')
    protected $table = 'ventas';

    // Los atributos que se pueden asignar de forma masiva
    protected $fillable = [
        'cliente_id',
        'total',
        'iva',
        'total_con_iva',
    ];

    // Relación con el modelo Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relación con el modelo Producto
    public function productos()
    {
        return $this->belongsToMany(Producto::class)
                    ->withPivot('cantidad', 'precio'); // Aquí puedes agregar más campos si es necesario
    }

    public function factura()
    {
        return $this->hasOne(Factura::class);
    }

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class);
    }
    

}
