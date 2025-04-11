<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Devolucion;
use App\Models\DetalleVenta;
use App\Models\Medicamento;
use App\Models\Usuario;

class DevolucionController extends Controller
{
    public function index()
    {
        $devoluciones = Devolucion::with('detalleVenta.medicamento', 'usuario')->get();
        return view('devolucion.index', compact('devoluciones'));
    }

    public function create()
    {
        $detalleVentas = DetalleVenta::with('medicamento')->get(); // Para que puedas mostrar el nombre del medicamento
        $usuarios = Usuario::all();
        return view('devolucion.create', compact('detalleVentas', 'usuarios'));
    }

    public function store(Request $request)
    { 
    
        $request->validate([
            'detalle_venta_id' => 'required|exists:detalle_ventas,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'cantidad' => 'required|integer|min:1',
            'fecha' => 'required|date',
            'motivo' => 'required|string|max:255',
        ]);
    
        $detalle = DetalleVenta::findOrFail($request->detalle_venta_id);
    
        if ($request->cantidad > $detalle->cantidad) {
            return back()->withErrors(['cantidad' => 'La cantidad devuelta no puede ser mayor a la comprada.'])->withInput();
        }
    
        $devolucion = Devolucion::create([
            'detalle_venta_id' => (int)$request->detalle_venta_id, 
            'usuario_id' => $request->usuario_id,
            'cantidad' => $request->cantidad,
            'fecha' => $request->fecha,
            'motivo' => $request->motivo,
        ]);
    
        $detalle->medicamento->decrement('stock', $devolucion->cantidad);
    
        return redirect()->route('devolucion.index')->with('success', 'Devolución registrada correctamente.');
    }
    

    public function show(string $id)
    {
        $devolucion = Devolucion::with('detalleVenta.medicamento', 'usuario')->findOrFail($id);
        return view('devolucion.show', compact('devolucion'));
    }

    public function edit(string $id)
    {
        $devolucion = Devolucion::findOrFail($id);
        $detalleVentas = DetalleVenta::with('medicamento')->get();
        $usuarios = Usuario::all();
        return view('devolucion.edit', compact('devolucion', 'detalleVentas', 'usuarios'));
    }

    public function update(Request $request, string $id)
    {
        $devolucion = Devolucion::findOrFail($id);

        $request->validate([
            'detalle_venta_id' => 'required|exists:detalle_ventas,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'cantidad' => 'required|integer|min:1',
            'fecha' => 'required|date',
            'motivo' => 'required|string|max:255',
        ]);

        // Restaurar stock anterior
        $devolucion->detalleVenta->medicamento->increment('stock', $devolucion->cantidad);

        $devolucion->update($request->all());

        // Restar nueva cantidad
        $nuevoDetalle = DetalleVenta::findOrFail($request->detalle_venta_id);
        $nuevoDetalle->medicamento->decrement('stock', $devolucion->cantidad);

        return redirect()->route('devolucion.index')->with('success', 'Devolución actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $devolucion = Devolucion::findOrFail($id);
        $devolucion->detalleVenta->medicamento->increment('stock', $devolucion->cantidad);
        $devolucion->delete();

        return redirect()->route('devolucion.index')->with('success', 'Devolución eliminada correctamente.');
    }

    public function confirmDelete($id)
    {
        $devolucion = Devolucion::findOrFail($id);
        return view('devolucion.delete', compact('devolucion'));
    }
}
