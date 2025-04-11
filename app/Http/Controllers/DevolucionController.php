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
        // Validación de los campos del formulario
        $request->validate([
            'detalle_venta_id' => 'required|exists:detalle_ventas,id', // Asegura que el detalle_venta_id existe
            'usuario_id' => 'required|exists:usuarios,id',
            'cantidad' => 'required|integer|min:1',
            'fecha' => 'required|date',
            'motivo' => 'required|string|max:255',
        ]);
    
        // Obtener el detalle de la venta seleccionado
        $detalle = DetalleVenta::findOrFail($request->detalle_venta_id);
    
        // Validar que no se devuelva más de lo comprado
        if ($request->cantidad > $detalle->cantidad) {
            return back()->withErrors(['cantidad' => 'La cantidad devuelta no puede ser mayor a la comprada.'])->withInput();
        }
    
        // Crear la devolución asegurándote de pasar los campos específicos
        $devolucion = Devolucion::create([
            'detalle_venta_id' => $request->detalle_venta_id,
            'usuario_id' => $request->usuario_id,
            'cantidad' => $request->cantidad,
            'fecha' => $request->fecha,
            'motivo' => $request->motivo,
        ]);
    
        // Actualizar el stock del medicamento
        $detalle->medicamento->decrement('stock', $devolucion->cantidad);
    
        // Redirigir al índice de devoluciones con mensaje de éxito
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
