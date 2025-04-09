<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicamentos = Medicamento::all();

        // Establecer el límite de días para la alerta de vencimiento (por ejemplo, 30 días)
        $diasLimite = 30;
        $fechaActual = Carbon::now();
        $alertaVencidos = false; // Variable para indicar si hay medicamentos vencidos
        
        // Verificar cada medicamento y agregar un campo 'alerta' si está cerca de vencer
        foreach ($medicamentos as $medicamento) {
            $fechaVencimiento = Carbon::parse($medicamento->fecha_vencimiento);
            $diferenciaDias = $fechaActual->diffInDays($fechaVencimiento);
    
            // Si la fecha de vencimiento ya pasó o está dentro del límite de días, activamos la alerta
            if ($fechaVencimiento <= $fechaActual || $diferenciaDias <= $diasLimite) {
                $medicamento->alerta_vencimiento = true;
                $alertaVencidos = true; // Marcar que hay medicamentos vencidos o cerca de vencer
            } else {
                $medicamento->alerta_vencimiento = false;
            }
        }
    
        return view('medicamento.index', compact('medicamentos'))
            ->with('alertaVencidos', $alertaVencidos); // Pasar la alerta de vencidos
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medicamento.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'unidad_medida' => 'required|in:mg,ml,tableta,caja',
            'precio' => 'required|numeric',
            'fecha_vencimiento' => 'required|date',
            'alerta_vencimiento' => 'nullable|boolean',
        ]);

        $alertaVencimiento = $request->alerta_vencimiento ?? false;

        Medicamento::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'stock' => $request->stock,
            'unidad_medida' => $request->unidad_medida,
            'precio' => $request->precio,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'alerta_vencimiento' => $alertaVencimiento,
        ]);

        return redirect()->route('medicamento.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $medicamento = Medicamento::findOrFail($id);
        return view('medicamento.show', compact('medicamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $medicamento = Medicamento::findOrFail($id);
        return view('medicamento.edit', compact('medicamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $medicamento = Medicamento::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'unidad_medida' => 'required|in:mg,ml,tableta,caja',
            'precio' => 'required|numeric',
            'fecha_vencimiento' => 'required|date',
            'alerta_vencimiento' => 'nullable|boolean',
        ]);

        $alertaVencimiento = $request->alerta_vencimiento ?? false;

        $medicamento->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'stock' => $request->stock,
            'unidad_medida' => $request->unidad_medida,
            'precio' => $request->precio,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'alerta_vencimiento' => $alertaVencimiento,
        ]);

        return redirect()->route('medicamento.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->delete();
        return redirect()->route('medicamento.index')->with('success', 'Medicamento eliminado con éxito');
    }
    
    /**
     * Show the confirmation for deleting the specified resource.
     */
    public function confirmDelete($id)
    {
        $medicamento = Medicamento::findOrFail($id);
        return view('medicamento.delete', compact('medicamento'));
    }

    /**
     * Search medicamentos by name or description.
     */
    public function search(Request $request)
    {
        $query = $request->input('query'); 
    
        $medicamentos = Medicamento::when($query, function ($q) use ($query) {
            return $q->where('nombre', 'LIKE', '%' . $query . '%')
                     ->orWhere('descripcion', 'LIKE', '%' . $query . '%');
        })->get();
    
        return view('medicamento.index', compact('medicamentos'));
    }

    public function reset()
    {
        $medicamentos = Medicamento::all();
        return view('medicamento.index', compact('medicamentos'));
    }

    public function searchInventario(Request $request)
{
    $query = $request->input('query');

    $medicamentos = Medicamento::when($query, function ($q) use ($query) {
        return $q->where('nombre', 'LIKE', '%' . $query . '%')
                 ->orWhere('descripcion', 'LIKE', '%' . $query . '%');
    })->get();

    return view('inventario.index', compact('medicamentos')); 
}

public function resetInventario()
{
    $medicamentos = Medicamento::all();
    return view('inventario.index', compact('medicamentos'));
}

}
