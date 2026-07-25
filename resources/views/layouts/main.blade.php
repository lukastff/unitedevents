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
                <a href="/" class="text-xl font-semibold text-gray-900 py-2 whitespace-nowrap">
                    United Events
                </a>
                <ul class="flex flex-col lg:flex-row list-none gap-1 lg:gap-4 m-0 p-0">
                    <li>
                        <a href="/" class="block px-3 py-2 text-gray-700 hover:text-gray-900 transition-colors">Eventos</a>
                    </li>
                    <li>
                        <a href="/" class="block px-3 py-2 text-gray-700 hover:text-gray-900 transition-colors">Criar Eventos</a>
                    </li>
                    <li>
                        <a href="/" class="block px-3 py-2 text-gray-700 hover:text-gray-900 transition-colors">Entrar</a>
                    </li>
                    <li>
                        <a href="/" class="block px-3 py-2 text-gray-700 hover:text-gray-900 transition-colors">Cadastrar</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    @yield("content")
    <footer>
        <p>HDC Events &copy; 2020</p>
    </footer>
</body>
</html>
