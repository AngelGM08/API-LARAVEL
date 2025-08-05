<?php

namespace App\Http\Controllers;

use App\Models\Produccion;
use Illuminate\Http\Request;

class ProduccionController extends Controller
{
    // Obtener una sola producción por ID con nombre del tamal
    public function index($id)
    {
        $produccion = Produccion::with('tamal')->find($id);

        if (!$produccion) {
            return response()->json(['error' => 'Producción no encontrada'], 404);
        }

        return response()->json([
            'id_produccion' => $produccion->id_produccion,
            'fecha' => $produccion->fecha,
            'cantidad_total' => $produccion->cantidad_total,
            'id_tamal' => $produccion->id_tamal,
            'nombre_tamal' => $produccion->tamal->nombre_tamal ?? 'Sin asignar',
        ]);
    }

    // Listar todas las producciones con nombre del tamal
    public function list()
    {
        $producciones = Produccion::with('tamal')->get();

        $resultado = $producciones->map(function ($item) {
            return [
                'id_produccion' => $item->id_produccion,
                'fecha' => $item->fecha,
                'cantidad_total' => $item->cantidad_total,
                'id_tamal' => $item->id_tamal,
                'nombre_tamal' => $item->tamal->nombre_tamal ?? 'Sin asignar',
            ];
        });

        return response()->json($resultado);
    }

    // Crear o actualizar una producción y devolver los datos con nombre del tamal
    public function store(Request $request)
    {
        $produccion = $request->id == 0 
            ? new Produccion()
            : Produccion::find($request->id);

        $produccion->id_tamal = $request->id_tamal;
        $produccion->fecha = $request->fecha;
        $produccion->cantidad_total = $request->cantidad_total;
        $produccion->save();

        $produccion->load('tamal');

        return response()->json([
            'status' => 'ok',
            'id_produccion' => $produccion->id_produccion,
            'fecha' => $produccion->fecha,
            'cantidad_total' => $produccion->cantidad_total,
            'id_tamal' => $produccion->id_tamal,
            'nombre_tamal' => $produccion->tamal->nombre_tamal ?? 'Sin asignar',
        ]);
    }

    // Eliminar una producción y retornar nombre del tamal eliminado
    public function destroy(Request $request)
    {
        $produccion = Produccion::with('tamal')->find($request->id);

        if (!$produccion) {
            return response()->json(['status' => 'not found'], 404);
        }

        $info = [
            'id_produccion' => $produccion->id_produccion,
            'id_tamal' => $produccion->id_tamal,
            'nombre_tamal' => $produccion->tamal->nombre_tamal ?? 'Sin asignar',
        ];

        $produccion->delete();

        return response()->json([
            'status' => 'ok',
            'eliminado' => $info,
        ]);
    }
}
