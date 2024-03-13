<?php

namespace App\Http\Controllers\Musica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artistas as Artista;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Validator;
class Artistas extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api_jwt', ['except' => []]);
    }

    public function index()
    {
        $artistas = Artista::with('albumes')
        ->get()
        ->where('estado', true);

        return response()->json(['Artistas' => $artistas]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'edad' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $artista = new Artista;
        $artista->nombre = $request->nombre;
        $artista->edad = $request->edad;
        $artista->save();
        return response()->json(['message' => 'Artista creado con exito']);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'edad' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $artista = Artista::find($id);
        if(!$artista){
            return response()->json(['error' => 'Artista no encontrado'], 404);
        }
        $artista->nombre = $request->nombre;
        $artista->edad = $request->edad;
        $artista->save();
        return response()->json(['message' => 'Artista actualizado con exito']);
    }

    public function destroy($id)
    {
        $artista = Artista::find($id);
        if(!$artista){
            return response()->json(['error' => 'Artista no encontrado'], 404);
        }
        $artista->estado = false;
        $artista->save();
        return response()->json(['message' => 'Artista eliminado con exito']);
    }
}
