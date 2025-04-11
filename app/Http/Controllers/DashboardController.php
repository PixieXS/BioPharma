<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Venta;
use App\Models\Medicamento;
use App\Models\Entrada;
use App\Models\Salida;
use App\Models\Devolucion;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsuarios = Usuario::count();

        $hoy = Carbon::today();
        $ventasHoy = Venta::whereDate('fecha', $hoy)->sum('total');

        $inventario = Medicamento::sum('stock');

        $entradasHoy = Entrada::whereDate('fecha', $hoy)->sum('cantidad');
        $salidasHoy = Salida::whereDate('fecha', $hoy)->sum('cantidad');

        $devolucionesHoy = Devolucion::whereDate('fecha', $hoy)->count();

        return view('dashboard.index', compact(
            'totalUsuarios', 
            'ventasHoy', 
            'inventario', 
            'entradasHoy', 
            'salidasHoy',
            'devolucionesHoy'
        ));
    }
}
