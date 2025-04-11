<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Medicamento;
use App\Models\Venta;
use App\Models\Entrada;
use App\Models\Salida;
use App\Models\Devolucion;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $month = Carbon::now()->month;
        $year  = Carbon::now()->year;

        $totalUsuarios = Usuario::count();

        $ventasMes = Venta::whereMonth('fecha', $month)
                          ->whereYear('fecha', $year)
                          ->where('estado', 'completada')
                          ->sum('total');

        $inventario = Medicamento::sum('stock');

        $entradasMes = Entrada::whereMonth('fecha', $month)
                              ->whereYear('fecha', $year)
                              ->sum('cantidad');

        $salidasMes = Salida::whereMonth('fecha', $month)
                            ->whereYear('fecha', $year)
                            ->where('tipo_salida', 'venta')
                            ->sum('cantidad');


        $devolucionesMes = Devolucion::whereMonth('fecha', $month)
                                     ->whereYear('fecha', $year)
                                     ->sum('cantidad');

        return view('dashboard', compact(
            'totalUsuarios',
            'ventasMes',
            'inventario',
            'entradasMes',
            'salidasMes',
            'devolucionesMes'
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
