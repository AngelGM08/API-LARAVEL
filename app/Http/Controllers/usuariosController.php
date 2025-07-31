<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class usuariosController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        return $user;
    }

    public function roles(Request $request)
    {
        $user = User::where('rol', $request->rol)->get();
        return $user;
    }

    public function list()
    {
        $user = User::all();
        return $user;
    }

    public function store(Request $request)
    {
        if ($request->id == 0) {
            $user = new User();
        } else {
            $user = User::find($request->id);
        }
        $user->name =  $request->name;
        $user->email =  $request->email;
        $user->password = Hash::make($request->password);
        $user->rol = $request->rol;
        $user->save();
        return 'ok';
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return 'ok';
    }
}
