<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //muestra la pagina para crear cuenta
    public function index()
    {
        return view('auth.register');
    }

    //metodo para crear cuenta
    public function store(Request $request)
    {
        //modificar el request para aplicar un slug al username
        $request->request->add(['username' => Str::slug($request->username)]);

        //validar los campos del formulario
        $this->validate($request, [
            'name' => ['required', 'min:3', 'max:60'],
            'username' => ['required', 'unique:users', 'alpha_dash:ascii', 'min:6', 'max:15'],
            'email' => ['required', 'email', 'unique:users', 'max:60'],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        //guardar en la base de datos
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        
        /**
         * -----------------------------------------------
         * | autenticar con el helper auth()
         * -----------------------------------------------
         */

        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        //otra forma de autenticar
        // auth()->attempt($request->only('email', 'password'));

        /**
         * -----------------------------------------------
         * | autenticar con la clase Auth
         * -----------------------------------------------
         */

        // $credentials = $request->validate([
        //         'email' => ['required', 'email'],
        //         'password' => ['required']
        // ]);
        
        // Auth::attempt($credentials);

        //el metodo attempt espra un array el cual es devuelto por el metodo only()
        Auth::attempt($request->only('email', 'password'));

        //redireccionar al muro
        return redirect()->route('posts.index', auth()->user()->username);

    }
}
