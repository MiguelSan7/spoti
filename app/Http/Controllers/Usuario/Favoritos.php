<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favoritos as Favorito;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class Favoritos extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api_jwt', ['except' => []]);
    }

    public function index()
    {
        $favoritos = Favorito::all()->where('id_usuario', Auth::user()->id);
        return response()->json(['Favoritos' => $favoritos]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_cancion' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $favorito = new Favorito;
        $favorito->id_usuario = Auth::user()->id;
        $favorito->artista_id = $request->id_cancion;
        $favorito->save();
        return response()->json(['message' => 'Favorito creado con exito']);
    }

    public function destroy($id)
    {
        $favorito = Favorito::find($id);
        if(!$favorito){
            return response()->json(['error' => 'Favorito no encontrado'], 404);
        }
        $favorito->delete();
        return response()->json(['message' => 'Favorito eliminado con exito']);
    }
}
