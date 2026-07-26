<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield("title")</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-white">
    <header>
        <nav class="flex flex-wrap items-center justify-between px-4 py-3 bg-white text-gray-900">
            <div id="navbar" class="hidden w-full lg:flex lg:items-center lg:w-auto">
                <a href="/" class="text-xl mr-[50px] font-semibold text-gray-900 py-2 whitespace-nowrap">
                    United Events
                </a>
                <ul class="flex flex-col lg:flex-row list-none gap-1 lg:gap-4 m-0 p-0">
                    <li>
                        <a href="/" class="block px-3 py-2 text-gray-700 hover:text-gray-900 transition-colors">Eventos</a>
                    </li>
                    <li>
                        <a href="/events/create" class="block px-3 py-2 text-gray-700 hover:text-gray-900 transition-colors">Criar Eventos</a>
                    </li>
                    @auth
                        <li>
                            <a href="/dashboard" class="block px-3 py-2 text-gray-700 hover:text-gray-900 transition-colors">Meu perfil</a>
                        </li>
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <a href="/logout"
                                   onclick="event.preventDefault();
                                   this.closest('form').submit();">Sair</a>
                            </form>
                        </li>
                    @endauth

                    @guest
                        <li>
                            <a href="/login" class="block px-3 py-2 text-gray-700 hover:text-gray-900 transition-colors">Entrar</a>
                        </li>
                        <li>
                            <a href="/register" class="block px-3 py-2 text-gray-700 hover:text-gray-900 transition-colors">Cadastrar</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div>
            <div>
                @if(session("msg"))
                    <p>{{ session("msg") }}</p>
                @endif
                @yield("content")
            </div>
        </div>
    </main>
    <footer>
        <p>United Events &copy; 2020</p>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.js"></script>
</body>
</html>
