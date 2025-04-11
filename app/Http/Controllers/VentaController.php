<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Medicamento;
use App\Models\Salida;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('detalleVentas.medicamento', 'usuario')->latest()->get();
        return view('venta.index', compact('ventas'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        $medicamentos = Medicamento::all();
        return view('venta.create', compact('usuarios', 'medicamentos'));
    }

    public function show(Venta $venta)
    {
        return redirect()->route('detalleventa.index', ['ventaId' => $venta->id]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'medicamentos' => 'required|array|min:1',
            'medicamentos.*.medicamento_id' => 'required|exists:medicamentos,id',
            'medicamentos.*.cantidad' => 'required|integer|min:1',
        ]);

        $totalVenta = 0;

        foreach ($request->medicamentos as $item) {
            $medicamento = Medicamento::findOrFail($item['medicamento_id']);
            if ($item['cantidad'] > $medicamento->stock) {
                return back()->withErrors(['cantidad' => "La cantidad de {$medicamento->nombre} excede el stock disponible."]);
            }
        }

        $venta = Venta::create([
            'usuario_id' => $request->usuario_id,
            'estado' => 'pendiente',
            'fecha' => $request->fecha ?? now()->toDateString(),
            'total' => 0,
        ]);

        foreach ($request->medicamentos as $item) {
            $medicamento = Medicamento::findOrFail($item['medicamento_id']);
            $precio_unitario = $medicamento->precio ?? 0;
            $subtotal = $precio_unitario * $item['cantidad'];
            $totalVenta += $subtotal;

            DetalleVenta::create([
                'venta_id' => $venta->id,
                'medicamento_id' => $medicamento->id,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $precio_unitario,
                'subtotal' => $subtotal,
            ]);
        }

        $venta->update(['total' => $totalVenta]);

        return redirect()->route('venta.index')->with('success', 'Venta registrada correctamente.');
    }

    public function edit(Venta $venta)
    {
        $venta->load('detalleVentas'); 
        $usuarios = Usuario::all();
        $medicamentos = Medicamento::all();
        return view('venta.edit', compact('venta', 'usuarios', 'medicamentos'));
    }

    public function update(Request $request, Venta $venta)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,completada,cancelada',
            'medicamentos' => 'required|array|min:1',
            'medicamentos.*.medicamento_id' => 'required|exists:medicamentos,id',
            'medicamentos.*.cantidad' => 'required|integer|min:1',
        ]);

        $totalVenta = 0;
        $estadoAnterior = $venta->estado;

        foreach ($request->medicamentos as $item) {
            $medicamento = Medicamento::findOrFail($item['medicamento_id']);
            if ($item['cantidad'] > $medicamento->stock) {
                return back()->withErrors(['cantidad' => "La cantidad de {$medicamento->nombre} excede el stock disponible."]);
            }
        }

        foreach ($request->medicamentos as $item) {
            $medicamento = Medicamento::findOrFail($item['medicamento_id']);
            $precio_unitario = $medicamento->precio ?? 0;
            $subtotal = $precio_unitario * $item['cantidad'];
            $totalVenta += $subtotal;

            $detalle = DetalleVenta::where('venta_id', $venta->id)
                                   ->where('medicamento_id', $medicamento->id)
                                   ->first();

            if ($detalle) {
                $detalle->update([
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $precio_unitario,
                    'subtotal' => $subtotal,
                ]);
            } else {
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'medicamento_id' => $medicamento->id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $precio_unitario,
                    'subtotal' => $subtotal,
                ]);
            }
        }

        if ($estadoAnterior === 'completada' && $request->estado !== 'completada') {
            foreach ($venta->detalleVentas as $detalle) {
                $medicamento = $detalle->medicamento;
                $medicamento->stock += $detalle->cantidad;
                $medicamento->save();
            }
        }

        if ($request->estado === 'completada') {
            foreach ($request->medicamentos as $item) {
                $medicamento = Medicamento::findOrFail($item['medicamento_id']);
                $medicamento->stock -= $item['cantidad'];
                $medicamento->save();

                Salida::create([
                    'medicamento_id' => $medicamento->id,
                    'usuario_id' => $venta->usuario_id,
                    'cantidad' => $item['cantidad'],
                    'tipo_salida' => 'venta',
                    'fecha' => $request->fecha ?? now()->toDateString(),
                ]);
            }
        }

        $venta->update([
            'estado' => $request->estado,
            'total' => $totalVenta,
            'fecha' => $request->fecha ?? now()->toDateString(),
        ]);

        return redirect()->route('venta.index')->with('success', 'Venta actualizada correctamente.');
    }

}
