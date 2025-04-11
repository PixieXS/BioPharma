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
}
