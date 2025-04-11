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

        $totalUsuarios = User::count();
        $ventasMes = Venta::whereMonth('created_at', $mesActual)->sum('total');
        $inventario = Medicamento::sum('cantidad');
        $entradasMes = Entrada::whereMonth('created_at', $mesActual)->count();
        $salidasMes = Salida::whereMonth('created_at', $mesActual)->count();
        $devolucionesMes = Devolucion::whereMonth('created_at', $mesActual)->count();

        $usuario = Auth::user();

        return view('dashboard', compact(
            'totalUsuarios',
            'ventasMes',
            'inventario',
            'entradasMes',
            'salidasMes',
            'devolucionesMes',
            'usuario'
        ));
        dd(Venta::pluck('created_at'));
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
