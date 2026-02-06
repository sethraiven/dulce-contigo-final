<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use Carbon\Carbon;

class PedidoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:30',
            'metodo_pago' => 'required|string',
            'comentarios' => 'nullable|string',
            'productos' => 'nullable|array',
            'image' => 'nullable|image|max:10240', // Max 10MB
        ]);

        // Validar que haya productos O imagen
        if (empty($request->productos) && !$request->hasFile('image')) {
            return response()->json(['ok' => false, 'message' => 'Debes agregar productos o subir una foto del pedido.'], 422);
        }

        $imagenPath = null;
        if ($request->hasFile('image')) {
            $imagenPath = $request->file('image')->store('pedidos', 'public');
        }

        Pedido::create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'metodo_pago' => $request->metodo_pago,
            'comentarios' => $request->comentarios,
            'productos' => $request->productos ? json_encode($request->productos) : null,
            'imagen_path' => $imagenPath,
            'estado' => 'pendiente',
        ]);

        return response()->json(['ok' => true]);
    }

    public function index()
    {
        $hoy = Carbon::today();
        $manana = Carbon::tomorrow();

        // Solo pedidos del día actual y que estén pendientes
        $pedidos = \App\Models\Pedido::whereBetween('created_at', [$hoy, $manana])
            ->where('estado', 'pendiente')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPedidosHoy = $pedidos->count();

        // Solo pedidos completados para el historial
        $historialPedidos = Pedido::where('estado', 'completado')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pedidos.index', compact('pedidos', 'totalPedidosHoy', 'historialPedidos'));
    }

    // Mostrar solo pedidos pendientes (puedes usar esta función para una vista específica si lo deseas)
    public function pendientes()
    {
        $pedidosPendientes = \App\Models\Pedido::where('estado', 'pendiente')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pedidos.pendientes', compact('pedidosPendientes'));
    }

    // Cambia destroy por completar
    public function completar($id)
    {
        $pedido = \App\Models\Pedido::findOrFail($id);
        $pedido->estado = 'completado';
        $pedido->save();
        return response()->json(['ok' => true]);
    }

    // Si quieres mantener destroy para eliminar definitivamente, puedes dejarlo así
    public function destroy($id)
    {
        $pedido = \App\Models\Pedido::findOrFail($id);
        $pedido->delete();
        return response()->json(['ok' => true]);
    }

    public function historial()
    {
        // Solo pedidos completados
        $historialPedidos = \App\Models\Pedido::where('estado', 'completado')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pedidos.historial', compact('historialPedidos'));
    }
}
