<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class ProveedorController extends Controller
{
    public function index($id)
    {
        $proveedor = Proveedor::find($id);
        return $proveedor;
    }

    public function list()
    {
        $proveedor = Proveedor::all();
        return $proveedor;
    }

    public function store(Request $request)
    {
        if ($request->id == 0) {
            $proveedor = new Proveedor();
        } else {
            $proveedor = Proveedor::find($request->id);
        }
        $proveedor->nombre           = $request->nombre;
        $proveedor->apellido_paterno = $request->apellido_paterno;
        $proveedor->apellido_materno = $request->apellido_materno;
        $proveedor->telefono         = $request->telefono;
        $proveedor->email            = $request->email;
        $proveedor->save();
        return 'ok';
    }

    public function destroy(Request $request)
    {
        $proveedor = Proveedor::find($request->id);
        $proveedor->delete();
        return 'ok';
    }
}
