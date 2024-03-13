<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Descargas as Descarga;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class Descargas extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api_jwt', ['except' => []]);
    }

    public function index()
    {
        $descargas = Descarga::all()->where('id_usuario', Auth::user()->id);
        return response()->json(['Descargas' => $descargas]);
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
        $descarga = new Descarga;
        $descarga->codigo = rand(100000, 999999);
        $descarga->id_usuario = Auth::user()->id;
        $descarga->artista_id = $request->artista_id;
        $descarga->save();
        return response()->json(['message' => 'Descarga creada con exito']);
    }

    public function destroy($id)
    {
        $descarga = Descarga::find($id);
        if(!$descarga){
            return response()->json(['error' => 'Descarga no encontrada'], 404);
        }
        $descarga->delete();
        return response()->json(['message' => 'Descarga eliminada con exito']);
    }
}
