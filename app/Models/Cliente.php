<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    
    // Definir la tabla asociada (opcional si la tabla se llama 'clientes')
    protected $table = 'clientes';

    // Los atributos que se pueden asignar de forma masiva
    protected $fillable = [
        'nombre',
        'cedula',
        'razon_social',
    ];
}
