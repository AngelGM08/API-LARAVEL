<?php

namespace App\Http\Controllers;

use App\Models\Produccion;
use Illuminate\Http\Request;

class ProduccionController extends Controller
{
    // Listar todas las producciones con nombre del tamal
    public function index()
    {
        $producciones = Produccion::with('tamal')->get();

        $formateadas = $producciones->map(function ($item) {
            return [
                'id_produccion' => $item->id_produccion,
                'fecha' => $item->fecha,
                'cantidad_total' => $item->cantidad_total,
                'id_tamal' => $item->id_tamal,
                'nombre_tamal' => $item->tamal->nombre_tamal ?? 'Sin asignar',
            ];
        });

        return response()->json($formateadas);
    }

    // Listar sin relaciones (si se requiere solo los campos puros)
    public function list()
    {
        return Produccion::all();
    }

    // Crear o actualizar producción
    public function store(Request $request)
    {
        $produccion = $request->id == 0 
            ? new Produccion() 
            : Produccion::find($request->id);

        $produccion->id_tamal = $request->id_tamal;
        $produccion->fecha = $request->fecha;
        $produccion->cantidad_total = $request->cantidad_total;
        $produccion->save();

        return response()->json(['status' => 'ok']);
    }

    // Eliminar una producción
    public function destroy(Request $request)
    {
        $produccion = Produccion::find($request->id);

        if ($produccion) {
            $produccion->delete();
            return response()->json(['status' => 'ok']);
        }

        return response()->json(['status' => 'not found'], 404);
    }
}
