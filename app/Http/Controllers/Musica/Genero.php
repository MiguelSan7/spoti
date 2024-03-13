<?php

namespace App\Http\Controllers\Musica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Generos;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Validator;
class Genero extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api_jwt', ['except' => []]);
    }

    public function index()
    {
        $generos = Generos::all();
        return response()->json(['Generos' => $generos]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $genero = new Generos;
        $genero->nombre = $request->nombre;
        $genero->save();
        return response()->json(['message' => 'Genero creado con exito']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $genero = Generos::find($id);
        if(!$genero){
            return response()->json(['error' => 'Genero no encontrado'], 404);
        }
        $genero->nombre = $request->nombre;
        $genero->save();
        return response()->json(['message' => 'Genero actualizado con exito']);
    }

    public function destroy($id)
    {
        $genero = Generos::find($id);
        if(!$genero){
            return response()->json(['error' => 'Genero no encontrado'], 404);
        }
        $genero->estado = false;
        return response()->json(['message' => 'Genero eliminado con exito']);
    }
}
