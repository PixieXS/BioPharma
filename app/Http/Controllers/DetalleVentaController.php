<?php

namespace App\Http\Controllers;
use App\Models\Venta;
use App\Models\Salida;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener el parametro 'ventaId' de la query string
        $ventaId = $request->query('ventaId');
        
        // Asegúrate de que 'ventaId' esté presente
        if (!$ventaId) {
            return redirect()->route('venta.index')->with('error', 'Venta ID no proporcionado');
        }

        // Obtener los detalles de la venta
        $detalles = DetalleVenta::with(['venta.usuario', 'medicamento'])
            ->where('venta_id', $ventaId)
            ->get();

        return view('detalleventa.index', compact('detalles'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta, DetalleVenta $detalleVenta)
    {
        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $medicamento = Medicamento::findOrFail($request->medicamento_id);

        // Revertir el stock de la cantidad anterior
        $medicamentoAnterior = Medicamento::find($detalleVenta->medicamento_id);
        $medicamentoAnterior->stock += $detalleVenta->cantidad;
        $medicamentoAnterior->save();

        // Verificar si hay suficiente stock para el medicamento
        if ($request->cantidad > $medicamento->stock) {
            return back()->withErrors(['cantidad' => 'La cantidad vendida no puede ser mayor al stock disponible.']);
        }

        // Actualizar el detalle de la venta
        $detalleVenta->update([
            'medicamento_id' => $medicamento->id,
            'cantidad' => $request->cantidad,
            'precio' => $medicamento->precio,
        ]);

        // Descontar el nuevo stock del medicamento
        $medicamento->stock -= $request->cantidad;
        $medicamento->save();

        return redirect()->route('venta.show', $venta->id)->with('success', 'Detalle de venta actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
