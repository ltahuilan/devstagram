<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // dd($request->remember);

        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        //verificar inicio de sesión
        if(!Auth::attempt($request->only('email', 'password'), $request->remember)) {
            
            return back()->with('mensaje', 'Las credenciales son incorrectas');
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }

}
