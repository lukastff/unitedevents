<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield("title")</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white font-sans text-zinc-900 antialiased">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-[60] focus:rounded-full focus:bg-accent focus:px-4 focus:py-2 focus:text-sm focus:text-white">
        Pular para o conteúdo
    </a>

    <header class="fixed inset-x-0 top-0 z-50 border-b border-zinc-200/70 bg-white/70 backdrop-blur-md">
        <nav class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
            <a href="/" class="shrink-0 text-lg font-semibold tracking-tight text-zinc-900 transition-opacity duration-300 hover:opacity-70">
                United Events
            </a>

            <ul class="hidden items-center gap-8 text-sm font-medium text-zinc-600 md:flex">
                <li>
                    <a href="/" class="transition-colors duration-300 hover:text-zinc-900">Eventos</a>
                </li>
                <li>
                    <a href="/events/create" class="transition-colors duration-300 hover:text-zinc-900">Criar evento</a>
                </li>
                @auth
                    <li>
                        <a href="/dashboard" class="transition-colors duration-300 hover:text-zinc-900">Meu perfil</a>
                    </li>
                @endauth
            </ul>

            <div class="flex items-center gap-2 sm:gap-3">
                <a href="/"
                   aria-label="Buscar eventos"
                   class="flex h-9 w-9 items-center justify-center rounded-full text-zinc-600 transition-colors duration-300 hover:bg-zinc-100 hover:text-zinc-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-accent">
                    <ion-icon name="search-outline" class="text-lg" aria-hidden="true"></ion-icon>
                </a>

                @auth
                    <form action="/logout" method="POST" class="hidden sm:block">
                        @csrf
                        <a href="/logout"
                           onclick="event.preventDefault(); this.closest('form').submit();"
                           class="rounded-full px-4 py-2 text-sm font-medium text-zinc-600 transition-colors duration-300 hover:bg-zinc-100 hover:text-zinc-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-accent">
                            Sair
                        </a>
                    </form>
                @else
                    <a href="/login"
                       class="hidden rounded-full px-4 py-2 text-sm font-medium text-zinc-600 transition-colors duration-300 hover:bg-zinc-100 hover:text-zinc-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-accent sm:block">
                        Entrar
                    </a>
                    <a href="/register"
                       class="rounded-full bg-accent px-4 py-2 text-sm font-medium text-white shadow-sm transition-all duration-300 ease-out hover:bg-accent-hover hover:shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-accent focus-visible:ring-offset-2">
                        Cadastrar
                    </a>
                @endguest
            </div>
        </nav>
    </header>

    <main id="main-content" class="pt-16">
        @if(session("msg"))
            <div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
                <p class="rounded-xl bg-accent/10 px-4 py-3 text-sm font-medium text-accent">
                    {{ session("msg") }}
                </p>
            </div>
        @endif

        @yield("content")
    </main>

    <footer class="border-t border-zinc-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center justify-between gap-4 md:flex-row">
                <p class="text-sm font-medium text-zinc-900">United Events</p>
                <ul class="flex items-center gap-6 text-sm text-zinc-500">
                    <li><a href="/" class="transition-colors duration-300 hover:text-zinc-900">Eventos</a></li>
                    <li><a href="/events/create" class="transition-colors duration-300 hover:text-zinc-900">Criar evento</a></li>
                    <li><a href="/terms" class="transition-colors duration-300 hover:text-zinc-900">Termos</a></li>
                    <li><a href="/policy" class="transition-colors duration-300 hover:text-zinc-900">Privacidade</a></li>
                </ul>
            </div>
            <p class="mt-6 text-center text-xs text-zinc-400 md:text-left">
                &copy; {{ date('Y') }} United Events. Todos os direitos reservados.
            </p>
        </div>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.js"></script>
</body>
</html>
