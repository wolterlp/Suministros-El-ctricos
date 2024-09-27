<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Definir los campos que se pueden llenar de forma masiva
    protected $fillable = ['nombre_producto', 'codigo_producto', 'precio', 'stock', 'estado'];
}
