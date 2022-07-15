<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {

        //Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        /*$this->validate($request, [
            'username' => ['required', 'unique:users','min:3','max:20', 'not_in:twitter,editar-perfil,lefcochupalo,lefco_chupalo,lefco-chupalo,perfil'],

        ]);*/

        /*if($request->imagen){
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." .$imagen->extension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
            //return response()->json(['imagen' => $imagen->extension()]);
        }

        //Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        //redireccionar
        return redirect()->route('posts.index', $usuario->username);*/

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil,lefcochupalo,lefco_chupalo,lefco-chupalo,perfil'],
            'email' => 'required|email|unique:users,imagen,'.auth()->user()->id,
        ]);
 
        if($request->imagen) {
            $imagen = $request->file('imagen');
 
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
    
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);
    
            $imagenPath = public_path('perfiles') . "/" . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }
 
        //Guardar Cambios
 
        $usuario = User::find(auth()->user()->id);
        $usuario->username = Str::slug($request->username);
        $usuario->email = $request->email ?? auth()->user()->email;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
 
        $usuario->save();
        
        if($request->oldpassword || $request->password) {
            $this->validate($request, [
                'password' => 'required|confirmed',
            ]);
 
            if (Hash::check($request->oldpassword, auth()->user()->password)) {
                $usuario->password = Hash::make($request->password) ?? auth()->user()->password;
                $usuario->save();
            } else {
                return back()->with('mensaje', 'La Contraseña Actual no Coincide');
            }
        }
        
        return redirect()->route('posts.index', $usuario->username);
    }
}
