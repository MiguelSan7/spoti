<?php

namespace App\Http\Controllers\Musica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Canciones as Cancion;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Validator;

class Canciones extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api_jwt', ['except' => []]);
    }

    public function index()
    {
        $canciones = Cancion::with('albumes', 'generos')
        ->get()
        ->where('estado', true);
        return response()->json(['Canciones' => $canciones]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'album_id' => 'required',
            'genero_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $cancion = new Cancion;
        $cancion->nombre = $request->nombre;
        $cancion->album_id = $request->album_id;
        $cancion->genero_id = $request->genero_id;
        $cancion->save();
        return response()->json(['message' => 'Cancion creada con exito']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'album_id' => 'required',
            'genero_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $cancion = Cancion::find($id);
        if(!$cancion){
            return response()->json(['error' => 'Cancion no encontrada'], 404);
        }
        $cancion->nombre = $request->nombre;
        $cancion->album_id = $request->album_id;
        $cancion->genero_id = $request->genero_id;
        $cancion->save();
        return response()->json(['message' => 'Cancion actualizada con exito']);
    }

    public function destroy($id)
    {
        $cancion = Cancion::find($id);
        if(!$cancion){
            return response()->json(['error' => 'Cancion no encontrada'], 404);
        }
        $cancion->estado = false;
        $cancion->save();
        return response()->json(['message' => 'Cancion eliminada con exito']);
    }
}
