<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>EVENTO FOTOGRAFICO WEB</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

        <style>
            body {
                /* background-image: url('assets/img/fondo.png'); */
                background-size: cover;
                background-repeat: no-repeat;
                margin: 0;
            }

            header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 80px;
                background-color: #dcfaff;
                display: flex;
                justify-content: space-between; /* Alinea los elementos en el centro horizontalmente */
                align-items: center;
                padding: 0 20px;
            }

            h1 {
                margin: 0;
            }
        </style>
    </head>
    <body class="antialiased">
        <header>
            <h3><strong>EVENTO FOTOGRAFICO WEB</strong></h3>
            <div class="header-buttons">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-primary">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary  mx-2"><strong>Iniciar sesion</strong></a>
    
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-success"><strong>Registrar</strong></a>
                        @endif
                    @endauth
                @endif
            </div>
        </header>
    </body>
</html>
