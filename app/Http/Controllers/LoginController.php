<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        //Intentar autenticar al usuario
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'Las credenciales son incorrectas');
        }

        //Redireccionar al muro en caso de pasar la utenticación
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
