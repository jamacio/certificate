<?php

namespace App\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController
{
    public function showLoginForm()
    {
        return view('user.login');
    }

    public function showRegistrationForm()
    {
        return view('user.register');
    }

    public function showMyAccountForm()
    {
        $idUser = session('id');
        if ($idUser) {
            $userInfo = User::where('id', $idUser)->get();
            $user = $userInfo->first();
            return view('user.myaccount', compact('user'));
        }
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

    public function register(Request $request)
    {
        $requestContent = $request->all();

        if (
            isset($requestContent['username']) && !empty($requestContent['username']) &&
            isset($requestContent['email']) && !empty($requestContent['email']) &&
            isset($requestContent['password']) && !empty($requestContent['password'])
        ) {

            $username = $requestContent['username'];
            $email = $requestContent['email'];
            $userPassword = md5($requestContent['password']);

            $user = new User();
            $user->username = $username;
            $user->email = $email;
            $user->password = $userPassword;
            $user->save();

            setSession('id', $user->id);
            setSession('success', 'success');
            redirect('/certificates');
            return;
        }
        setSession('error', 'error');
        redirect('/register');
        return;
    }

    public function myAccount(Request $request)
    {
        $requestContent = $request->all();
        if (
            isset($requestContent['username']) && !empty($requestContent['username']) &&
            isset($requestContent['email']) && !empty($requestContent['email']) &&
            isset($requestContent['password']) && !empty($requestContent['password'])
        ) {
            $username = $requestContent['username'];
            $email = $requestContent['email'];
            $userPassword = md5($requestContent['password']);
            $idUser = session('id');
            $user = user::find($idUser);
            $user->username = $username;
            $user->email = $email;
            $user->password = $userPassword;
            $user->save();

            setSession('success', 'success');
            return;
        }

        setSession('error', 'error');
        return;
    }
}
