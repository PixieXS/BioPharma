<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    //
    use HasFactory;

    // Agrega los campos al array fillable
    protected $fillable = ['venta_id', 'medicamento_id', 'cantidad', 'precio_unitario', 'subtotal'];

    public function venta() {
        return $this->belongsTo(Venta::class);
    }
    
    public function medicamento() {
        return $this->belongsTo(Medicamento::class);
    }
    

}
