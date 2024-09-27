<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    // Definir la tabla asociada
    protected $table = 'facturas';

    // Los atributos que se pueden asignar de forma masiva
    protected $fillable = [
        'numero_factura',
        'venta_id',
        'cliente_id',
        'total_factura',
    ];

    // Relación con el modelo Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
