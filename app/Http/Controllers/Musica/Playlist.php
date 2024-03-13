<?php

namespace App\Http\Controllers\Musica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Playlist as Playlists;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Validator;

class Playlist extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api_jwt', ['except' => []]);
    }

    public function index()
    {
        $playlists = Playlists::all();
        return response()->json(['Playlists' => $playlists]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $playlist = new Playlists;
        $playlist->nombre = $request->nombre;
        $playlist->save();
        return response()->json(['message' => 'Playlist creado con exito']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $playlist = Playlists::find($id);
        if(!$playlist){
            return response()->json(['error' => 'Playlist no encontrado'], 404);
        }
        $playlist->nombre = $request->nombre;
        $playlist->save();
        return response()->json(['message' => 'Playlist actualizado con exito']);
    }

    public function destroy($id)
    {
        $playlist = Playlists::find($id);
        if(!$playlist){
            return response()->json(['error' => 'Playlist no encontrado'], 404);
        }
        $playlist->estado = false;
        return response()->json(['message' => 'Playlist eliminado con exito']);
    }
}
