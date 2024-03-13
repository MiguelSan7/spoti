<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Cancion_Playlist;

class Canciones_Playlist extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api_jwt', ['except' => []]);
    }

    public function index()
    {
        $cancionesPlaylist = CancionPlaylist::whereHas('playlist', function ($query) {
            $query->where('activo', true);
        })->whereHas('cancion', function ($query) {
            $query->where('activo', true);
        })->get();

        $cancionesPlaylistConNombrePlaylist = [];
    
        foreach ($cancionesPlaylist as $item) {
            $nombrePlaylist = $item->playlist->nombre;
            $canciones = $item->playlist->canciones;
    
            $cancionesPlaylistConNombrePlaylist[] = [
                'nombre_playlist' => $nombrePlaylist,
                'canciones' => $canciones
            ];
        }
    
        return response()->json($cancionesPlaylistConNombrePlaylist);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_cancion' => 'required|array',
            'id_cancion.*' => 'required|integer',
            'id_playlist' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $cancionPlaylist = new CancionPlaylist;
        $cancionPlaylist->id_cancion = $request->id_cancion;
        $cancionPlaylist->id_playlist = $request->id_playlist;
        $cancionPlaylist->save();
        return response()->json(['message' => 'CancionPlaylist creado con exito']);
    }

    public function destroy($id)
    {
        $cancionPlaylist = CancionPlaylist::find($id);
        if(!$cancionPlaylist){
            return response()->json(['error' => 'CancionPlaylist no encontrado'], 404);
        }
        $cancionPlaylist->delete();
        return response()->json(['message' => 'CancionPlaylist eliminado con exito']);
    }
}
