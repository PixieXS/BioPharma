<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicamento extends Model
{
    //
    use HasFactory;

    // Agrega estos campos al array fillable
    protected $fillable = [
        'nombre',
        'descripcion',
        'stock',
        'unidad_medida',
        'precio',
        'fecha_vencimiento',
        'alerta_vencimiento',
    ];

    public function devoluciones()
{
    return $this->hasMany(Devolucion::class);
}
}
