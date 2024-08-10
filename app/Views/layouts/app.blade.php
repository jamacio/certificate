<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ url('public/css/main.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="shortcut icon" href="{{ url('public/img/log.svg') }}" type="image/x-icon">


</head>

<body>
    @if(session('id'))
    <div class="sidebar">
        <div>
            <img src="../img/log.svg" alt="logo do site LDV Digital" />
        </div>
        <a href="../certificates">
            <img class="icons" src="../img/iconHome.png" />
            Certificados
        </a>

        <a href="../myaccount/">
            <img class="icons" src="../img/iconPerfil.png" />
            Perfil
        </a>


        <a href="../logout" class="btnClosed">
            <img class="icons" src="../img/iconSair.png" />
            Sair
        </a>
    </div>
    </div>
    @endif

    @yield('content')
</body>

</html>