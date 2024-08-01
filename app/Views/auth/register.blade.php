@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container">
    <form action="/register" method="post">
        <input type="text" name="username" placeholder="Nome de Usuário" />
        <input type="email" name="email" placeholder="E-mail" />
        <input type="password" name="password" placeholder="Senha" />
        <button type="submit">Register</button>
    </form>
</div>
@endsection