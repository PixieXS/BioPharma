<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $fillable = ['medicamento_id', 'cantidad', 'costo_unitario', 'fecha', 'proveedor'];

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }

    protected static function booted()
    {
        static::created(function ($entrada) {
            $entrada->medicamento->increment('stock', $entrada->cantidad);
        });
    }
}