<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    //
    protected $table = 'devoluciones';

    protected $fillable = [
        'detalle_venta_id',
        'usuario_id',
        'cantidad',
        'fecha',
        'motivo',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }  

    public function detalleVenta()
    {
        return $this->belongsTo(DetalleVenta::class, 'detalle_venta_id');
    }

 }
