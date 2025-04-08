<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            if ($user->estado === 'inactivo') { 
                Auth::logout();
                return back()->withErrors(['email' => 'Tu cuenta está inactiva. Contacta al administrador.']);
            }
    
            return redirect()->route($user->rol == 'root' ? 'menuadmin' : 'menubasico');
        }
    
        return back()->withErrors(['email' => 'Credenciales inválidas']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login.login');
    }
}
