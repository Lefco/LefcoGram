<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index () 
    {
        return view('auth.register');
    }

    /*public function store(Request $request)//Verificar que es lo que se esta enviando vardump de laravel
    {
        dd($request);//dd imprime y termina toda la ejecucion
        dd($request->get('username'))-->acceder directamente a un valor y verficar
    }*/

    public function store(request $request)
    {

        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'name' => 'required|min:5|max:15 ',
            'username' => 'required|unique:users|min:3|max:20',
            'email'=> 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:8'

        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);


        //autenticar usuario
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);
        /*
        otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));
        */

        //redireccion
        //return redirect()->route('posts.index');
        return redirect()->route('posts.index', auth()->user()->username);

    }

   
}
