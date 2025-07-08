<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function registerAction(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email:dns|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
        ], [
            'firstname.required' => 'Le prénom est obligatoire.',
            'firstname.regex' => 'Le prénom contient des caractères non autorisés.',

            'lastname.required' => 'Le nom est obligatoire.',
            'lastname.regex' => 'Le nom contient des caractères non autorisés.',

            'email.required' => 'L’adresse email est obligatoire.',
            'email.email' => 'L’adresse email n’est pas valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',

            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.regex' => 'Le mot de passe doit contenir une majuscule, une minuscule et un chiffre.',
        ]);

        // Création du client
        User::create([
            ...$validated,
            'password' => Hash::make($validated['password']),
        ]);

        // Redirection avec message flash
        return redirect()->route('login')->with('success', 'Compte créé avec succès !');
    }

    public function loginAction(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Vous êtes maintenant connecté !');
        }

        return back()->withErrors([
            'email' => 'Les identifiants sont incorrects',
        ])->onlyInput('email');
    }

    public function checkUser()
    {
        return response()->json([
            'authenticated' => Auth::check(),
            'user' => Auth::user()
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/")->with('success', 'Vous êtes maintenant déconnecté !');
    }
}
