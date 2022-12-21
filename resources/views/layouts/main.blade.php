<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <!-- Google fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <!-- CSS only -->
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <!-- css -->
        <link rel="stylesheet" href="/css/styles.css">
        <!-- js -->
        <script src="/js/scripts.js"></script>
    </head>
    <body>
      <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
              <div id="navbar" class="collapse navbar-collapse ">
                <a class="navbar-brand"><img src="/img/hdcevents_logo.svg" alt="HDC Events"></a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                      <a class="nav-link" href="/">Eventos </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="/events/create">Criar Eventos </a>
                    </li>
                    <li class="nav-item ">
                      <a class="nav-link" href="/">Entrar </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="/">Cadastrar</a>
                    </li> 
                     <li class="nav-item">
                      <a class="nav-link " href="/events/contact">Contato</a>
                    </li>
                </ul>
            </div>
          </nav>
      </header>
      <main>
        <div class="container-fluid">
          <div class="row">
            @if(session('msg'))
              <p class="msg"> {{ session('msg')}}</p>
            @endif
            @yield('content')
          </div>
        </div>
      </main>
      <footer class="align-bottom">
            <p>HDC Events &copy; 2022</p>
      </footer>
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>
