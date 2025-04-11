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
        $detalleVentas = DetalleVenta::with('medicamento')->get(); // Para mostrar nombre del medicamento
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

    // Obtener las devoluciones previas, incluyendo las devoluciones previas para ese detalle de venta
    $devolucionesPrevias = Devolucion::where('detalle_venta_id', $detalle->id)
                                     ->sum('cantidad');

    // Calcular el total de devoluciones tras la nueva
    $totalTrasNuevaDevolucion = $devolucionesPrevias + $request->cantidad;

    // Verificar que no se exceda la cantidad de productos comprados
    if ($totalTrasNuevaDevolucion > $detalle->cantidad) {
        return back()->withErrors(['cantidad' => 'La cantidad total devuelta excede la cantidad comprada.'])->withInput();
    }

    // Crear la nueva devolución
    $devolucion = Devolucion::create([
        'detalle_venta_id' => (int)$request->detalle_venta_id,
        'usuario_id' => $request->usuario_id,
        'cantidad' => $request->cantidad,
        'fecha' => $request->fecha,
        'motivo' => $request->motivo,
    ]);

    // Actualizar el stock del medicamento
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
    
        $detalle = DetalleVenta::findOrFail($request->detalle_venta_id);
    
        // Sumamos todas las devoluciones EXCEPTO esta misma
        $otrasDevoluciones = Devolucion::where('detalle_venta_id', $detalle->id)
            ->where('id', '!=', $devolucion->id)
            ->sum('cantidad');
    
        $totalConNuevaCantidad = $otrasDevoluciones + $request->cantidad;
    
        if ($totalConNuevaCantidad > $detalle->cantidad) {
            return back()->withErrors(['cantidad' => 'La cantidad total devuelta excede la cantidad comprada.'])->withInput();
        }
    
        // Restaurar el stock anterior
        $devolucion->detalleVenta->medicamento->increment('stock', $devolucion->cantidad);
    
        // Actualizar devolución
        $devolucion->update([
            'detalle_venta_id' => $request->detalle_venta_id,
            'usuario_id' => $request->usuario_id,
            'cantidad' => $request->cantidad,
            'fecha' => $request->fecha,
            'motivo' => $request->motivo,
        ]);
    
        // Restar la nueva cantidad al stock del medicamento
        $detalle->medicamento->decrement('stock', $request->cantidad);
    
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
