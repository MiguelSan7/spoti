<?php

namespace App\Http\Controllers\Musica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Albumes as Album;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Validator;


class Albumes extends Controller
{
   public function __construct()
   {
       $this->middleware('auth:api_jwt', ['except' => []]);
   }

    public function index()
    {
         $albumes = Album::with('artistas')
         ->get()
         ->where('estado', true);
         return response()->json(['Albumes' => $albumes]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'artista_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $album = new Album;
        $album->nombre = $request->nombre;
        $album->artista_id = $request->artista_id;
        $album->save();
        return response()->json(['message' => 'Album creado con exito']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'artista_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $album = Album::find($id);
        if(!$album){
            return response()->json(['error' => 'Album no encontrado'], 404);
        }
        $album->nombre = $request->nombre;
        $album->artista_id = $request->artista_id;
        $album->save();
        return response()->json(['message' => 'Album actualizado con exito']);
    }

    public function destroy($id)
    {
        $album = Album::find($id);
        if(!$album){
            return response()->json(['error' => 'Album no encontrado'], 404);
        }
        $album->estado = false;
        return response()->json(['message' => 'Album eliminado con exito']);
    }
}
