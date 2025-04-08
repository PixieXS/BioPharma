<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Devolucion;
use App\Models\Medicamento;

class DevolucionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devoluciones = Devolucion::all();
        return view('devolucion.index', compact('devoluciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicamentos = Medicamento::all();  
        $usuarios = \App\Models\Usuario::all(); 
        return view('devolucion.create', compact('medicamentos', 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'cantidad' => 'required|integer|min:1',
            'fecha' => 'required|date',
            'motivo' => 'required|string|max:255',
        ]);

        // Crear la devolución
        $devolucion = Devolucion::create($request->all());

        // Actualizar el stock del medicamento (restando la cantidad devuelta)
        $medicamento = Medicamento::findOrFail($request->medicamento_id);
        $medicamento->decrement('stock', $devolucion->cantidad);

        return redirect()->route('devolucion.index')->with('success', 'Devolución registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $devolucion = Devolucion::findOrFail($id);
        return view('devolucion.show', compact('devolucion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $devolucion = Devolucion::findOrFail($id);
        $medicamentos = Medicamento::all();  
        $usuarios = \App\Models\Usuario::all();  
        return view('devolucion.edit', compact('devolucion', 'medicamentos', 'usuarios')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $devolucion = Devolucion::findOrFail($id);

        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'cantidad' => 'required|integer|min:1',
            'fecha' => 'required|date',
            'motivo' => 'required|string|max:255',
        ]);

        // Obtener medicamento antes de actualizar la devolución
        $medicamentoAnterior = $devolucion->medicamento;
        $cantidadAnterior = $devolucion->cantidad;

        // Actualizar la devolución
        $devolucion->update($request->all());

        // Actualizar el stock del medicamento
        $medicamentoNuevo = Medicamento::findOrFail($request->medicamento_id);
        
        // Ajustar el stock del medicamento anterior
        $medicamentoAnterior->increment('stock', $cantidadAnterior);

        // Ajustar el stock del nuevo medicamento
        $medicamentoNuevo->decrement('stock', $devolucion->cantidad);

        return redirect()->route('devolucion.index')->with('success', 'Devolución actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $devolucion = Devolucion::findOrFail($id);
        $medicamento = $devolucion->medicamento;

        // Aumentar el stock del medicamento relacionado si se elimina la devolución
        $medicamento->increment('stock', $devolucion->cantidad);

        // Eliminar la devolución
        $devolucion->delete();

        return redirect()->route('devolucion.index')->with('success', 'Devolución eliminada correctamente.');
    }

    /**
     * Show the confirmation for deleting the specified resource.
     */
    public function confirmDelete($id)
    {
        $devolucion = Devolucion::findOrFail($id);
        return view('devolucion.delete', compact('devolucion'));
    }
}
