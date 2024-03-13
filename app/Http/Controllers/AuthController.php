<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Codigos;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;;
use App\Mail\ActivateUser;
use App\Mail\LogUser;
use App\Mail\SuccesActivate;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api_jwt', ['except' => ['register', 'activate', 'logCode', 'verifyCode', 'checkActive']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    
     public function login()
     {
         $credentials = request(['email', 'password']);
 
         if (! $token = auth()->attempt($credentials)) {
             return response()->json(['error' => 'Unauthorized'], 401);
         }
         return $this->respondWithToken($token);
     }
  
    public function me()
    {
        return response()->json(Auth::guard('api_jwt')->user());
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api_jwt')->factory()->getTTL() * 60
        ]);
    }

    public function activate(User $user){
        $user->estado = true;
        $user->save();
        Mail::to($user->email)->send(new ActivateUser($user));
        return view('Succesfull.succes')->with('user', $user);
    }

    public function checkActive(User $user){
       
        if($user->estado == true){
            return response()->json(['active' => true]);
        }
        return response()->json(['active' => false]);
 
        
    }

    public function logCode(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        if($user){
            $code = rand(100000, 999999);
            $codigo = Codigos::where('id_usuario', $user->id)->first();
            if ($codigo) {
                $codigo->codigo = Hash::make($code);
                $codigo->save();
            } else {
                $codigo = new Codigos;
                $codigo->id_usuario = $user->id;
                $codigo->codigo = Hash::make($code);
                $codigo->save();
            }
            Mail::to($user->email)->send(new LogUser($code));
            return response()->json(['message' => 'Código enviado']);
        }
        return response()->json(['message' => 'Usuario no encontrado'], 400);
    }

    public function verifyCode(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
            'codigo' => 'required|integer',
        ]);
        $correo = $request->email;
        $contraseña = $request->password;
        $code = $request->codigo;
        $user = User::where('email', $correo)->first();
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $codigo = Codigos::where('id_usuario', $user->id)->first();
        if (!$codigo || !Hash::check($code, $codigo->codigo)) {
            return response()->json(['message' => 'Código incorrecto'], 400);
        }
        $credentials = ['email' => $correo, 'password' => $contraseña];
        if (!$token = Auth::guard('api_jwt')->attempt($credentials)) {
            return response()->json(['error' => 'Credenciales incorrectas'], 401);
        }
        return $this->respondWithToken($token);
    }
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
            'id_suscripcion' => 'required|integer',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = new User();
        $user->nombres = $request->nombres;
        $user->apellidos = $request->apellidos;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->id_suscripcion = $request->id_suscripcion;
        $user->save();
        $signed_route = URL::temporarySignedRoute(
            'activate', now()->addMinutes(30), ['user' => $user->id]);
        Mail::to($user->email)->send(new ActivateUser($signed_route));
        return response()->json([
            'message' => 'Usuario creado con éxito, revise su correo para activar la cuenta',
            'id' => $user->id
        ], 201);
    }
}