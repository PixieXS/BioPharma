<?php

namespace App\Http\Controllers;
use App\Models\Medicamento;
use Illuminate\Http\Request;

class InventarioController extends Controller
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
    
        return view('inventario.index', compact('medicamentos'))
            ->with('alertaVencidos', $alertaVencidos); // Pasar la alerta de vencidos
    }

    /**
     * Search medicamentos by name or description.
     */
    public function searchInventario(Request $request)
    {
        $query = $request->input('query'); 

        $medicamentos = Medicamento::when($query, function ($q) use ($query) {
            return $q->where('nombre', 'LIKE', '%' . $query . '%')
                     ->orWhere('descripcion', 'LIKE', '%' . $query . '%');
        })->get();

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
        
        return view('inventario.index', compact('medicamentos'))
            ->with('alertaVencidos', $alertaVencidos); // Pasar la alerta de vencidos
    }
    /**
     * Reset the medicamento search to show all medicamentos.
     */
    public function resetInventario()
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

        return view('inventario.index', compact('medicamentos'))
            ->with('alertaVencidos', $alertaVencidos); // Pasar la alerta de vencidos
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
