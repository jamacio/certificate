<?php

namespace App\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UserController
{

    public function showLoginForm()
    {
        return view('auth.login');
    }



    public function login(Request $request)
    {
        $pageEnd = '/';
        $requestParam = [];
        $content = $request->getContent();
        $requestContent = json_decode($content, true);
        if (isset($requestContent['user_login']) && isset($requestContent['user_password'])) {
            $userLogin = $requestContent['user_login'];
            $userPassword = md5($requestContent['user_password']);
        }

        parse_str($content, $requestParam);

        $userLogin = $requestParam['user_login'] ?? '';
        $userPassword = md5($requestParam['user_password'] ?? '');

        $user = User::where('email', $userLogin)->first();

        if ($user && $user->password == $userPassword) {
            $_SESSION['id'] = $user->id;
            $pageEnd = '/certificates';
        }


        $response = new RedirectResponse($pageEnd);
        $response->send();

        return;
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
