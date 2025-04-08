<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'usuario_id',
        'fecha',
        'total',
        'estado',
    ];

    public function detalleVentas() {
        return $this->hasMany(DetalleVenta::class);
    }
    
    public function usuario() {
        return $this->belongsTo(Usuario::class);
    }
    
}
