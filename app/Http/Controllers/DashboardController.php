<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Venta;
use App\Models\Entrada;
use App\Models\Salida;
use App\Models\Devolucion;
use App\Models\Medicamento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $mesActual = Carbon::now()->month;
        $anioActual = Carbon::now()->year; 
    
        $totalUsuarios = Usuario::count();
        $ventasMes = Venta::whereMonth('created_at', $mesActual)
                          ->whereYear('created_at', $anioActual)
                          ->sum('total');
        $inventario = DB::table('medicamentos')->count();
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
    
        // Aquí es donde combinas tus vistas
        return view('menu.menuadmin', compact(
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
