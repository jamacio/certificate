<?php

namespace App\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController
{
    public function showLoginForm()
    {
        return view('auth.login');
    }



    public function login(Request $request)
    {

        // Validação dos dados recebidos
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tenta autenticar o usuário
        if (Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password']
        ])) {
            // Redireciona para a página inicial ou dashboard
            return redirect()->intended('dashboard')->with('success', 'Login realizado com sucesso.');
        } else {
            // Redireciona de volta ao formulário com uma mensagem de erro
            return redirect()->back()->with('error', 'Credenciais inválidas.');
        }
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validação dos dados recebidos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Criação de um novo usuário
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->save();

        // Loga o usuário recém-criado
        Auth::login($user);

        // Redireciona para a página inicial ou dashboard com uma mensagem de sucesso
        return redirect()->intended('dashboard')->with('success', 'Registro realizado com sucesso.');
    }
}
