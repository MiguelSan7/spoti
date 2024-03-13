<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Suscripciones as Suscripcion;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class Suscripciones extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api_jwt', ['except' => ['index']]);
    }

    public function index()
    {
        $suscripciones = Suscripcion::all();
        return response()->json(['Suscripciones' => $suscripciones]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'precio' => 'required',
            'duracion' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $suscripcion = new Suscripcion;
        $suscripcion->nombre = $request->nombre;
        $suscripcion->precio = $request->precio;
        $suscripcion->duracion = $request->duracion;
        $suscripcion->save();
        return response()->json(['message' => 'Suscripcion creada con exito']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'precio' => 'required',
            'duracion' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $suscripcion = Suscripcion::find($id);
        if(!$suscripcion){
            return response()->json(['error' => 'Suscripcion no encontrada'], 404);
        }
        $suscripcion->nombre = $request->nombre;
        $suscripcion->precio = $request->precio;
        $suscripcion->duracion = $request->duracion;
        $suscripcion->save();
        return response()->json(['message' => 'Suscripcion actualizada con exito']);
    }

    public function destroy($id)
    {
        $suscripcion = Suscripcion::find($id);
        if(!$suscripcion){
            return response()->json(['error' => 'Suscripcion no encontrada'], 404);
        }
        $suscripcion->delete();
        return response()->json(['message' => 'Suscripcion eliminada con exito']);
    }
}
