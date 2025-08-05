<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index($id)
    {
        $producto = Producto::find($id);
        return $producto;
    }

    public function list()
    {
        $producto = Producto::all();
        return $producto;
    }

    public function store(Request $request)
    {
        if ($request->id == 0) {
            $producto = new Producto();
        } else {
            $producto = Producto::find($request->id);
        }

        $producto->nombre_prod = $request->nombre_prod;
        $producto->descripcion = $request->descripcion;
        $producto->precio_unitario = $request->precio_unitario;
        $producto->save();
        return response()->json([
            'status' => 'ok',
            
        ]);
    }

    public function destroy(Request $request)
{
    try {
        $producto = Producto::find($request->id);

        if (!$producto) {
            return response()->json(['status' => 'not found'], 404);
        }

        $info = [
            'id_producto' => $producto->id_producto,
            'nombre_prod' => $producto->nombre_prod ?? 'Sin nombre',
        ];

        $producto->delete();

        return response()->json([
            'status' => 'ok',
            'eliminado' => $info,
        ]);

    } catch (QueryException $e) {
    if ($e->getCode() === '23503') {
        return response()->json([
            'status' => 'foreign_key_violation',
            'message' => 'Este producto está relacionado con otras operaciones y no puede eliminarse.',
        ], 409);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'Ocurrió un error inesperado al eliminar el producto.',
    ], 500);
}

}

}
