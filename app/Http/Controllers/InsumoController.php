<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use Illuminate\Http\Request;

class InsumoController extends Controller
{
    // 1. Mostrar todos los insumos con relaciones (producto y tamal)
    public function index()
    {
        return Insumo::with([
            'compra.producto',        // Relación: compra -> producto
            'produccion.tamal'        // Relación: producción -> tamal
        ])->get();
    }

    // 2. Guardar nuevo insumo
    public function store(Request $request)
    {
        $request->validate([
            'id_produccion' => 'required|exists:produccion,id_produccion',
            'id_compra' => 'required|exists:compras,id_compra',
            'cantidad_usada' => 'required|numeric|min:0',
        ]);

        return Insumo::create($request->all());
    }

    // 3. Mostrar un insumo específico con relaciones
    public function show($id)
    {
        return Insumo::with([
            'compra.producto',
            'produccion.tamal'
        ])->findOrFail($id);
    }

    // 4. Actualizar insumo
    public function update(Request $request, $id)
    {
        $insumo = Insumo::findOrFail($id);

        $request->validate([
            'id_produccion' => 'sometimes|exists:produccion,id_produccion',
            'id_compra' => 'sometimes|exists:compras,id_compra',
            'cantidad_usada' => 'sometimes|numeric|min:0',
        ]);

        $insumo->update($request->all());

        return $insumo->load(['compra.producto', 'produccion.tamal']);
    }

    // 5. Eliminar insumo
    public function destroy($id)
    {
        Insumo::findOrFail($id)->delete();

        return response()->json(['message' => 'Insumo eliminado correctamente']);
    }
}
