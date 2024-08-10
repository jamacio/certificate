@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <form action="/login" method="post">
        <input type="text" name="user_login" value="jamacio@hotmail.com" placeholder="E-mail" />
        <input type="text" name="user_password" value="net12345" placeholder="Senha" />
        <button type="submit">Login</button>
    </form>
</div>
@endsection