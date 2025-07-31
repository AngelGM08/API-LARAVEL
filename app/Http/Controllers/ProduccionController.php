<?php

namespace App\Http\Controllers;

use App\Models\Produccion;
use Illuminate\Http\Request;

class ProduccionController extends Controller
{
    public function index($id)
    {
        $produccion = Produccion::find($id);
        return $produccion;
    }

    public function list()
    {
        $produccion = Produccion::all();
        return $produccion;
    }

    public function store(Request $request)
    {
        if ($request->id == 0) {
            $produccion = new Produccion();
        } else {
            $produccion = Produccion::find($request->id);
        }

        $produccion->id_tamal = $request->id_tamal;
        $produccion->fecha = $request->fecha;
        $produccion->cantidad_total = $request->cantidad_total;
        $produccion->save();
        return 'ok';
    }

    public function destroy(Request $request)
    {
        $produccion = Produccion::find($request->id);
        $produccion->delete();
        return 'ok';
    }
}
