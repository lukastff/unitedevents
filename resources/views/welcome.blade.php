@extends('layouts.main')

@section('title', 'United Events')

@section('content')
    <section class="mx-auto max-w-7xl px-4 pb-12 pt-16 text-center sm:px-6 sm:pb-16 sm:pt-24 lg:px-8">
        <h1 class="text-4xl font-semibold tracking-tight text-zinc-900 sm:text-5xl lg:text-6xl">
            Encontre o seu próximo evento
        </h1>
        <p class="mx-auto mt-4 max-w-2xl text-lg font-normal text-zinc-500">
            Descubra experiências perto de você e confirme presença em segundos.
        </p>

        <form action="/" method="GET" class="mx-auto mt-10 flex max-w-xl items-center gap-2">
            <label for="search" class="sr-only">Buscar eventos</label>
            <div class="relative flex-1">
                <ion-icon name="search-outline"
                          class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-lg text-zinc-400"
                          aria-hidden="true"></ion-icon>
                <input type="text"
                       id="search"
                       name="search"
                       value="{{ $search }}"
                       placeholder="Procurar por nome do evento..."
                       class="w-full rounded-full border border-zinc-200 bg-zinc-50 py-3 pl-11 pr-4 text-sm text-zinc-900 shadow-sm transition-all duration-300 ease-out placeholder:text-zinc-400 focus:border-accent focus:bg-white focus:outline-none focus:ring-2 focus:ring-accent/30">
            </div>
            <button type="submit"
                    class="shrink-0 rounded-full bg-accent px-6 py-3 text-sm font-medium text-white shadow-sm transition-all duration-300 ease-out hover:bg-accent-hover hover:shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-accent focus-visible:ring-offset-2">
                Buscar
            </button>
        </form>
    </section>

    <section id="events-container" class="mx-auto max-w-7xl px-4 pb-24 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-end justify-between border-b border-zinc-100 pb-6">
            @if($search)
                <div>
                    <h2 class="text-2xl font-semibold tracking-tight text-zinc-900">Resultados para "{{ $search }}"</h2>
                    <p class="mt-1 text-sm text-zinc-500">{{ count($events) }} evento(s) encontrado(s)</p>
                </div>
                <a href="/"
                   class="hidden shrink-0 rounded-full px-4 py-2 text-sm font-medium text-accent transition-colors duration-300 hover:bg-accent/10 sm:block">
                    Limpar busca
                </a>
            @else
                <div>
                    <h2 class="text-2xl font-semibold tracking-tight text-zinc-900">Próximos eventos</h2>
                    <p class="mt-1 text-sm text-zinc-500">Veja os eventos dos próximos dias</p>
                </div>
            @endif
        </div>

        @if(count($events) > 0)
            <div id="cards-container" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($events as $event)
                    <article class="group overflow-hidden rounded-2xl border border-zinc-100 bg-white shadow-sm transition-all duration-300 ease-out hover:-translate-y-1 hover:shadow-md">
                        <a href="/events/{{ $event->id }}" class="block aspect-[4/3] overflow-hidden bg-zinc-100">
                            <img src="/img/events/{{ $event->image }}"
                                 alt="{{ $event->title }}"
                                 class="h-full w-full object-cover transition-transform duration-300 ease-out group-hover:scale-105">
                        </a>
                        <div class="p-5">
                            <div class="flex items-center gap-1.5 text-xs font-medium text-zinc-400">
                                <ion-icon name="calendar-outline" aria-hidden="true"></ion-icon>
                                <span>{{ date("d/m/Y", strtotime($event->date)) }}</span>
                            </div>

                            <h3 class="mt-2 truncate text-lg font-semibold tracking-tight text-zinc-900">
                                <a href="/events/{{ $event->id }}" class="transition-colors duration-300 hover:text-accent">
                                    {{ $event->title }}
                                </a>
                            </h3>

                            <div class="mt-1 flex items-center gap-1.5 text-sm text-zinc-500">
                                <ion-icon name="location-outline" aria-hidden="true"></ion-icon>
                                <span class="truncate">{{ $event->city }}</span>
                            </div>

                            <div class="mt-4 flex items-center justify-between border-t border-zinc-100 pt-4">
                                <div class="flex items-center gap-1.5 text-sm text-zinc-500">
                                    <ion-icon name="people-outline" aria-hidden="true"></ion-icon>
                                    <span>{{ count($event->users) }} participantes</span>
                                </div>
                                <a href="/events/{{ $event->id }}"
                                   class="text-sm font-medium text-accent transition-colors duration-300 hover:text-accent-hover focus:outline-none focus-visible:ring-2 focus-visible:ring-accent focus-visible:rounded-full">
                                    Ver detalhes
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-zinc-200 px-6 py-24 text-center">
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-zinc-100">
                    <ion-icon name="calendar-clear-outline" class="text-2xl text-zinc-400" aria-hidden="true"></ion-icon>
                </div>
                @if($search)
                    <h3 class="mt-6 text-lg font-semibold text-zinc-900">Nenhum evento encontrado</h3>
                    <p class="mt-2 max-w-sm text-sm text-zinc-500">
                        Não encontramos eventos para "{{ $search }}". Tente outro termo de busca.
                    </p>
                    <a href="/"
                       class="mt-6 rounded-full bg-accent px-5 py-2.5 text-sm font-medium text-white shadow-sm transition-all duration-300 ease-out hover:bg-accent-hover hover:shadow-md">
                        Ver todos os eventos
                    </a>
                @else
                    <h3 class="mt-6 text-lg font-semibold text-zinc-900">Nenhum evento disponível</h3>
                    <p class="mt-2 max-w-sm text-sm text-zinc-500">
                        Ainda não há eventos cadastrados. Seja o primeiro a criar um.
                    </p>
                    <a href="/events/create"
                       class="mt-6 rounded-full bg-accent px-5 py-2.5 text-sm font-medium text-white shadow-sm transition-all duration-300 ease-out hover:bg-accent-hover hover:shadow-md">
                        Criar evento
                    </a>
                @endif
            </div>
        @endif
    </section>
@endsection
