<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Salida;
use App\Models\Medicamento;
use App\Models\Usuario;
use Illuminate\Http\Request;

class SalidaController extends Controller
{
    public function index()
    {
        $salidas = Salida::all();
        return view('salida.index', compact('salidas'));
    }

    public function create()
    {
        $medicamentos = Medicamento::all();
        return view('salida.create', compact('medicamentos'));
    }

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

        $usuarioId = Auth::user()->id;

        $salida = Salida::create([
            'medicamento_id' => $request->medicamento_id,
            'usuario_id' => $usuarioId,
            'cantidad' => $request->cantidad,
            'tipo_salida' => $request->tipo_salida,
            'fecha' => $request->fecha,
        ]);

        $medicamento->decrement('stock', $salida->cantidad);

        return redirect()->route('salida.index')->with('success', 'Salida registrada correctamente.');
    }

    public function show(string $id)
    {
        $salida = Salida::findOrFail($id);
        return view('salida.show', compact('salida'));
    }

    public function edit(string $id)
    {
        $salida = Salida::findOrFail($id);
        $medicamentos = Medicamento::all();
        return view('salida.edit', compact('salida', 'medicamentos'));
    }

    public function update(Request $request, string $id)
    {
        $salida = Salida::findOrFail($id);

        $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id',
            'cantidad' => 'required|integer|min:1',
            'tipo_salida' => 'required|in:venta,ajuste',
            'fecha' => 'required|date',
        ]);

        $medicamentoAnterior = $salida->medicamento;
        $cantidadAnterior = $salida->cantidad;

        $salida->update([
            'medicamento_id' => $request->medicamento_id,
            'usuario_id' => $salida->usuario_id, // no lo cambiamos
            'cantidad' => $request->cantidad,
            'tipo_salida' => $request->tipo_salida,
            'fecha' => $request->fecha,
        ]);

        $medicamentoNuevo = Medicamento::findOrFail($request->medicamento_id);

        if ($request->tipo_salida == 'venta' && $medicamentoNuevo->stock < $request->cantidad) {
            return redirect()->back()->withErrors(['cantidad' => 'No hay suficiente stock disponible para esta venta.']);
        }

        if ($salida->tipo_salida == 'venta') {
            $medicamentoAnterior->increment('stock', $cantidadAnterior);
        }

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

    public function destroy(string $id)
    {
        $salida = Salida::findOrFail($id);
        $medicamento = $salida->medicamento;

        $medicamento->increment('stock', $salida->cantidad);

        $salida->delete();

        return redirect()->route('salida.index')->with('success', 'Salida eliminada con éxito');
    }

    public function confirmDelete($id)
    {
        $salida = Salida::findOrFail($id);
        return view('salida.delete', compact('salida'));
    }
}
