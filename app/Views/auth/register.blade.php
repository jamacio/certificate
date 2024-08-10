@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container">
    <form action="/register" method="POST">
        <input type="text" name="username" value="jamacio@jamacio.com" placeholder="Nome de Usuário" />
        <input type="email" name="email" value="jamacio@jamacio.com" placeholder="E-mail" />
        <input type="password" name="password" value="jamacio@jamacio.com" placeholder="Senha" />
        <button type="submit">Register</button>
    </form>
</div>
@endsection