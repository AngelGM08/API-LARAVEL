<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index($id)
    {
        $compra = Compra::find($id);
        return $compra;
    }

    public function list()
    {
        $compra = Compra::all();
        return $compra;
    }

    public function store(Request $request)
    {
        if ($request->id == 0) {
            $compra = new Compra();
        } else {
            $compra = Compra::find($request->id);
        }

        $compra->id_proveedor = $request->id_proveedor;
        $compra->id_producto = $request->id_producto;
        $compra->cantidad = $request->cantidad;
        $compra->unidad = $request->unidad;
        $compra->total = $request->total;
        $compra->save();
        return 'ok';
    }

    public function destroy(Request $request)
    {
        $compra = Compra::find($request->id);
        $compra->delete();
        return 'ok';
    }
}
