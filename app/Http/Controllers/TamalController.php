<?php

namespace App\Http\Controllers;

use App\Models\Tamal;
use Illuminate\Http\Request;

class TamalController extends Controller
{
    public function index($id)
    {
        $tamal = Tamal::find($id);
        return $tamal;
    }

    public function list()
    {
        $tamal = Tamal::all();
        return $tamal;
    }

    public function store(Request $request)
    {
        if ($request->id == 0) {
            $tamal = new Tamal();
        } else {
            $tamal = Tamal::find($request->id);
        }

        $tamal->nombre_tamal = $request->nombre_tamal;
        $tamal->descripcion = $request->descripcion;
        $tamal->save();
        return 'ok';
    }

    public function destroy(Request $request)
    {
        $tamal = Tamal::find($request->id);
        $tamal->delete();
        return 'ok';
    }
}
