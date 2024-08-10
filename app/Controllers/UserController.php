<?php

namespace App\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $pageEnd = '/';
        $requestContent = $request->all();
        if (isset($requestContent['user_login']) && isset($requestContent['user_password'])) {
            $userLogin = $requestContent['user_login'];
            $userPassword = md5($requestContent['user_password']);
        }

        $user = User::where('email', $userLogin)->first();

        if ($user && $user->password == $userPassword) {
            setSession('id', $user->id);
            $pageEnd = '/certificates';
        }


        redirect($pageEnd);
        return;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $pageEnd = '/register';
        $requestContent = $request->all();

        if (
            isset($requestContent['username']) && !empty($requestContent['username']) &&
            isset($requestContent['email']) && !empty($requestContent['email']) &&
            isset($requestContent['password']) && !empty($requestContent['password'])
        ) {

            $username = $requestContent['username'];
            $email = $requestContent['email'];
            $userPassword = md5($requestContent['password']);

            $user = new User;
            $user->username = $username;
            $user->email = $email;
            $user->password = $userPassword;
            $user->save();


            die('fdsfdsf');

            setSession('id', $user->id);
            $pageEnd = '/certificates';
        }


        redirect($pageEnd);
        return;
    }
}
