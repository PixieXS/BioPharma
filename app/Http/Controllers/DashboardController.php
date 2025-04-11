<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Venta;
use App\Models\Entrada;
use App\Models\Salida;
use App\Models\Devolucion;
use App\Models\Medicamento;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $mesActual = Carbon::now()->month;
    $anioActual = Carbon::now()->year; // Obtenemos el año actual

    $totalUsuarios = User::count();

    // Aseguramos que solo tomamos las ventas del mes y año actuales
    $ventasMes = Venta::whereMonth('created_at', $mesActual)
                      ->whereYear('created_at', $anioActual)
                      ->sum('total');

    // El inventario total no depende del mes, por eso solo se consulta una vez
    $inventario = Medicamento::sum('cantidad');

    // Lo mismo para las entradas, salidas y devoluciones: añadiendo el filtro de año
    $entradasMes = Entrada::whereMonth('created_at', $mesActual)
                          ->whereYear('created_at', $anioActual)
                          ->count();

    $salidasMes = Salida::whereMonth('created_at', $mesActual)
                        ->whereYear('created_at', $anioActual)
                        ->count();

    $devolucionesMes = Devolucion::whereMonth('created_at', $mesActual)
                                 ->whereYear('created_at', $anioActual)
                                 ->count();

    $usuario = Auth::user();

    // Retornamos todos los datos a la vista
    return view('dashboard', compact(
        'totalUsuarios',
        'ventasMes',
        'inventario',
        'entradasMes',
        'salidasMes',
        'devolucionesMes',
        'usuario'
    ));
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
