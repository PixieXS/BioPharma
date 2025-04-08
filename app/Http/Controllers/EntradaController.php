<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Medicamento;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entradas = Entrada::all();
        return view('entrada.index', compact('entradas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicamentos = Medicamento::all(); // Obtener todos los medicamentos
        return view('entrada.create', compact('medicamentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'cantidad' => 'required|integer|min:1',
            'costo_unitario' => 'required|numeric',
            'fecha' => 'required|date',
            'proveedor' => 'nullable|string',
        ]);

        // Crear la entrada
        $entrada = Entrada::create([
            'medicamento_id' => $request->medicamento_id,
            'cantidad' => $request->cantidad,
            'costo_unitario' => $request->costo_unitario,
            'fecha' => $request->fecha,
            'proveedor' => $request->proveedor,
        ]);

        // Actualizar el stock del medicamento
        $medicamento = Medicamento::findOrFail($request->medicamento_id);
        $medicamento->increment('stock', $entrada->cantidad); // Incrementar el stock

        return redirect()->route('entrada.index')->with('success', 'Entrada registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entrada = Entrada::findOrFail($id);
        return view('entrada.show', compact('entrada'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $entrada = Entrada::findOrFail($id);
        $medicamentos = Medicamento::all(); // Obtener todos los medicamentos
        return view('entrada.edit', compact('entrada', 'medicamentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $entrada = Entrada::findOrFail($id);

        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'cantidad' => 'required|integer|min:1',
            'costo_unitario' => 'required|numeric',
            'fecha' => 'required|date',
            'proveedor' => 'nullable|string',
        ]);

        // Obtener medicamento antes de actualizar la entrada
        $medicamentoAnterior = $entrada->medicamento;
        $cantidadAnterior = $entrada->cantidad;

        // Actualizar la entrada
        $entrada->update([
            'medicamento_id' => $request->medicamento_id,
            'cantidad' => $request->cantidad,
            'costo_unitario' => $request->costo_unitario,
            'fecha' => $request->fecha,
            'proveedor' => $request->proveedor,
        ]);

        // Actualizar el stock de los medicamentos
        $medicamentoNuevo = Medicamento::findOrFail($request->medicamento_id);
        
        // Descontar el stock del medicamento anterior
        $medicamentoAnterior->decrement('stock', $cantidadAnterior);

        // Incrementar el stock del nuevo medicamento
        $medicamentoNuevo->increment('stock', $entrada->cantidad);

        return redirect()->route('entrada.index')->with('success', 'Entrada actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $entrada = Entrada::findOrFail($id);
        $medicamento = $entrada->medicamento;

        // Disminuir el stock del medicamento relacionado
        $medicamento->decrement('stock', $entrada->cantidad);

        // Eliminar la entrada
        $entrada->delete();

        return redirect()->route('entrada.index')->with('success', 'Entrada eliminada con éxito');
    }

    /**
     * Show the confirmation for deleting the specified resource.
     */
    public function confirmDelete($id)
    {
        $entrada = Entrada::findOrFail($id);
        return view('entrada.delete', compact('entrada'));
    }
}
