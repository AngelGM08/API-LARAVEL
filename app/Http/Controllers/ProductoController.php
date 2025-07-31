<?php

namespace App\Http\Controllers;

use App\Models\Producto;
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
        return 'ok';
    }

    public function destroy(Request $request)
    {
        $producto = Producto::find($request->id);
        $producto->delete();
        return 'ok';
    }
}
