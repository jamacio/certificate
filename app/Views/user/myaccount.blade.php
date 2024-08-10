@extends('layouts.app')

@section('title', 'myaccount')

@section('content')
<div class="container">
    myaccount
    <form action="/register" method="POST">
        <input type="text" name="username" value="{{ $user->username }}" placeholder="Nome de Usuário" />
        <input type="email" name="email" value="{{ $user->email }}" placeholder="E-mail" />
        <input type="password" name="password" value="{{ $user->password }}" placeholder="Senha" />
        <button type="submit">Register</button>
    </form>
</div>
@endsection