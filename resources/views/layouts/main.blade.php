<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HDC Events</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="/css/styles.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    </head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse" id="navbar">
                <a href="/" class="navbar-brand">
                <img src="/img/log.jpg" alt="HDC Events" />
                </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Eventos <ion-icon name="calendar-number-outline"></ion-icon></a>
                        </li>
                        <li class="nav-item">
                            <a href="/events/create" class="nav-link">Criar eventos 
                            <ion-icon name="add-outline"></ion-icon>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav-link">Cadastrar
                            <ion-icon name="checkmark-circle-outline"></ion-icon>
                            </a>
                        </li>
                    </ul>
                </a>
            </div>
        </nav>
    </header>
   
    <main>
        <div class="container-fluid">
            <div id="row">
                @if(session('msg'))
                    <p class="msg">{{session('msg')}}</p>
                @endif
            </div>
        </div>
    </main>
    @yield('content')
    <footer>
        <p>HDC EVENTS &copy; 2022 </p>
    </footer>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>