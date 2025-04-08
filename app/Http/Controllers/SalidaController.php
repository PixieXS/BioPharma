<?php

namespace App\Http\Controllers;

use App\Models\Salida;
use App\Models\Medicamento;
use App\Models\Usuario;
use Illuminate\Http\Request;

class SalidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salidas = Salida::all();
        return view('salida.index', compact('salidas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicamentos = Medicamento::all(); // Obtener todos los medicamentos
        $usuarios = Usuario::where('rol', 'root')->get(); // Obtener usuarios Root
        return view('salida.create', compact('medicamentos', 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'medicamento_id' => 'required|exists:medicamentos,id',
        'cantidad' => 'required|integer|min:1',
        'tipo_salida' => 'required|in:venta,ajuste',
        'fecha' => 'required|date',
    ]);

    $medicamento = Medicamento::findOrFail($request->medicamento_id);

    if ($request->tipo_salida == 'venta' && $medicamento->stock < $request->cantidad) {
        return redirect()->back()->withErrors(['cantidad' => 'No hay suficiente stock disponible para esta venta.']);
    }

    // Obtener usuario logueado
    $usuarioId = Auth::user()->id;

    $salida = Salida::create([
        'medicamento_id' => $request->medicamento_id,
        'usuario_id' => $usuarioId, // Automático
        'cantidad' => $request->cantidad,
        'tipo_salida' => $request->tipo_salida,
        'fecha' => $request->fecha,
    ]);

    $medicamento->decrement('stock', $salida->cantidad);

    return redirect()->route('salida.index')->with('success', 'Salida registrada correctamente.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $salida = Salida::findOrFail($id);
        return view('salida.show', compact('salida'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $salida = Salida::findOrFail($id);
        $medicamentos = Medicamento::all(); // Obtener todos los medicamentos
        $usuarios = Usuario::where('rol', 'root')->get(); // Obtener usuarios Root
        return view('salida.edit', compact('salida', 'medicamentos', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $salida = Salida::findOrFail($id);
    
        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'usuario_id' => 'required|exists:usuarios,id',
            'cantidad' => 'required|integer|min:1',
            'tipo_salida' => 'required|in:venta,ajuste',
            'fecha' => 'required|date',
        ]);
    
        // Obtener medicamento antes de actualizar la salida
        $medicamentoAnterior = $salida->medicamento;
        $cantidadAnterior = $salida->cantidad;
    
        // Actualizar la salida
        $salida->update([
            'medicamento_id' => $request->medicamento_id,
            'usuario_id' => $request->usuario_id,
            'cantidad' => $request->cantidad,
            'tipo_salida' => $request->tipo_salida,
            'fecha' => $request->fecha,
        ]);
    
        // Obtener el nuevo medicamento
        $medicamentoNuevo = Medicamento::findOrFail($request->medicamento_id);
    
        // Verificar si hay suficiente stock antes de actualizar
        if ($request->tipo_salida == 'venta' && $medicamentoNuevo->stock < $request->cantidad) {
            return redirect()->back()->withErrors(['cantidad' => 'No hay suficiente stock disponible para esta venta.']);
        }
    
        // Si la salida anterior era de tipo 'venta', reponer el stock de lo que se vendió anteriormente
        if ($salida->tipo_salida == 'venta') {
            $medicamentoAnterior->increment('stock', $cantidadAnterior);
        }
    
        // Descontar el stock de la salida nueva
        if ($request->tipo_salida == 'venta') {
            $medicamentoNuevo->decrement('stock', $request->cantidad);
        } else {
            if ($request->cantidad > $cantidadAnterior) {
                $medicamentoNuevo->increment('stock', $request->cantidad - $cantidadAnterior);
            } else {
                $medicamentoNuevo->decrement('stock', $cantidadAnterior - $request->cantidad);
            }
        }
    
        return redirect()->route('salida.index')->with('success', 'Salida actualizada correctamente.');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $salida = Salida::findOrFail($id);
        $medicamento = $salida->medicamento;

        // Actualizar el stock del medicamento relacionado
        if ($salida->tipo_salida == 'venta') {
            $medicamento->increment('stock', $salida->cantidad);
        } else {
            $medicamento->increment('stock', $salida->cantidad);
        }

        // Eliminar la salida
        $salida->delete();

        return redirect()->route('salida.index')->with('success', 'Salida eliminada con éxito');
    }

    public function confirmDelete($id)
    {
        $salida = Salida::findOrFail($id);
        return view('salida.delete', compact('salida'));
    }
}
