<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Utilisateur;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // On récupère les champs du formulaire
        $credentials = [
            'uti_email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('accueil');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects']);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $request->validate([
        'uti_nom' => 'required|string|max:255',
        'uti_prenom' => 'required|string|max:255',
        'uti_email' => 'required|string|email|max:255|unique:utilisateurs,uti_email',
        'uti_password' => 'required|string|min:6|confirmed',
    ]);

    $user = Utilisateur::create([
        'uti_nom' => $request->uti_nom,
        'uti_prenom' => $request->uti_prenom,
        'uti_email' => $request->uti_email,
        'uti_password' => bcrypt($request->uti_password),
        'role' => 'client',
    ]);

    Auth::login($user);

    return redirect()->route('accueil');
}

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
