<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuarios_Playlist as Usuarios_Playlists;
class Usuarios_Playlist extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api_jwt', ['except' => []]);
    }

    public function index()
    {
        $usuarios_playlists = Usuarios_Playlists::all()->where('id_usuario', Auth::user()->id);
        return response()->json(['Usuarios_Playlists' => $usuarios_playlists]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_playlist' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $usuarios_playlist = new Usuarios_Playlists;
        $usuarios_playlist->id_usuario = Auth::user()->id;
        $usuarios_playlist->id_playlist = $request->id_playlist;
        $usuarios_playlist->save();
        return response()->json(['message' => 'Usuarios_Playlist creado con exito']);
    }

    public function destroy($id)
    {
        $usuarios_playlist = Usuarios_Playlists::find($id);
        if(!$usuarios_playlist){
            return response()->json(['error' => 'Usuarios_Playlist no encontrado'], 404);
        }
        $usuarios_playlist->delete();
        return response()->json(['message' => 'Usuarios_Playlist eliminado con exito']);
    }
}
