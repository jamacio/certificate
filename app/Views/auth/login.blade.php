@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <form action="/login" method="post">
        <input type="text" name="user_login" placeholder="E-mail" />
        <input type="password" name="user_password" placeholder="Senha" />
        <button type="submit">Login</button>
    </form>
</div>
@endsection