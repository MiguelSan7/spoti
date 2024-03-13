<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Historial as Historiales;

class Historial extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api_jwt', ['except' => []]);
    }

    public function index()
    {
        $historiales = Historiales::all()->where('id_usuario', Auth::user()->id);
        return response()->json(['Historiales' => $historiales]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_cancion' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $historial = new Historiales;
        $historial->id_usuario = Auth::user()->id;
        $historial->cancion_id = $request->id_cancion;
        $historial->save();
        return response()->json(['message' => 'Historial creado con exito']);
    }

    public function destroy($id)
    {
        $historial = Historiales::find($id);
        if(!$historial){
            return response()->json(['error' => 'Historial no encontrado'], 404);
        }
        $historial->delete();
        return response()->json(['message' => 'Historial eliminado con exito']);
    }
}
