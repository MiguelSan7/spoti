<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class Usuarios extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api_jwt', ['except' => []]);
    }

    public function index()
    {
        $usuarios = User::all();
        return response()->json(['Usuarios' => $usuarios]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $usuario = new User;
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();
        return response()->json(['message' => 'Usuario creado con exito']);
    }

    public function update(Request $request, $id)
    {
        $usuario = User::find($id);
        if(!$usuario){
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->password = bcrypt($request->password);
        $usuario->save();
        return response()->json(['message' => 'Usuario actualizado con exito']);
    }

    public function destroy($id)
    {
        $usuario = User::find($id);
        if(!$usuario){
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
        $usuario->estado = false;
        $usuario->save();
        return response()->json(['message' => 'Usuario eliminado con exito']);
    }
}
