<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Roles as Rol;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class Roles extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api_jwt', ['except' => []]);
    }

    public function index()
    {
        $roles = Rol::where('nombre', '!=', 'Administrador')
        ->where('estado', true)
        ->get();
        return response()->json(['Roles' => $roles]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $rol = new Rol;
        $rol->nombre = $request->nombre;
        $rol->save();
        return response()->json(['message' => 'Rol creado con exito']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $rol = Rol::find($id);
        if(!$rol){
            return response()->json(['error' => 'Rol no encontrado'], 404);
        }
        $rol->nombre = $request->nombre;
        $rol->save();
        return response()->json(['message' => 'Rol actualizado con exito']);
    }

    public function destroy($id)
    {
        $rol = Rol::find($id);
        if(!$rol){
            return response()->json(['error' => 'Rol no encontrado'], 404);
        }
        $rol->estado = false;
        $rol->save();
        return response()->json(['message' => 'Rol eliminado con exito']);
    }

}
