<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with(['cliente', 'detalles.producto'])->latest()->get();
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas', compact('ventas', 'clientes', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'fecha_venta' => 'required|date',
            'estado' => 'required|in:pendiente,confirmada,cancelada',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        // Validar Stock
        if ($producto->stock < $request->cantidad) {
            return redirect()->back()->withErrors(['stock' => "El producto '{$producto->nombre}' no tiene suficiente stock disponible."]);
        }

        DB::transaction(function () use ($request, $producto) {
            $subtotal = $producto->precio * $request->cantidad;

            $venta = Venta::create([
                'cliente_id' => $request->cliente_id,
                'fecha_venta' => $request->fecha_venta,
                'estado' => $request->estado,
                'total' => $subtotal,
            ]);

            DetalleVenta::create([
                'venta_id' => $venta->id,
                'producto_id' => $producto->id,
                'cantidad' => $request->cantidad,
                'precio_unitario' => $producto->precio,
                'total' => $subtotal,
            ]);

            // Descontar stock
            $producto->decrement('stock', $request->cantidad);
        });

        return redirect()->back()->with('success', 'Venta registrada con éxito.');
    }

    public function update(Request $request, Venta $venta)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,confirmada,cancelada',
        ]);

        $venta->update(['estado' => $request->estado]);

        return redirect()->back()->with('success', 'Estado de la venta actualizado.');
    }

    public function destroy(Venta $venta)
    {
        // Validación: solo eliminar si el estado es cancelada o pendiente
        if (!in_array($venta->estado, ['pendiente', 'cancelada'])) {
            return redirect()->back()->withErrors(['delete' => 'Solo se pueden eliminar ventas con estado pendiente o cancelada.']);
        }

        $venta->delete();
        return redirect()->back()->with('success', 'Venta eliminada.');
    }
}