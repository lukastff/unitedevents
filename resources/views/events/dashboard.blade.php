@extends("layouts.main")

@section("title", "Dashboard")

@section("content")
    <section class="mx-auto max-w-5xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
        <div class="mb-12 text-center">
            <h1 class="text-4xl font-semibold tracking-tight text-zinc-900 sm:text-5xl">
                Meu painel
            </h1>
            <p class="mt-4 text-lg text-zinc-500">
                Gerencie os eventos que você criou e acompanhe onde está participando.
            </p>
        </div>

        <div class="space-y-16">
            <div>
                <div class="mb-6 flex items-center justify-between">
                    <h2 class="text-2xl font-semibold tracking-tight text-zinc-900">Meus eventos</h2>
                    <a href="{{ route('events.create') }}"
                       class="hidden items-center gap-1.5 rounded-full bg-accent px-4 py-2 text-sm font-medium text-white shadow-sm transition-all duration-300 ease-out hover:bg-accent-hover hover:shadow-md sm:inline-flex">
                        <ion-icon name="add-outline" aria-hidden="true"></ion-icon>
                        Criar evento
                    </a>
                </div>

                @if(count($events) > 0)
                    <div class="overflow-hidden rounded-2xl border border-zinc-100 shadow-sm">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-zinc-50 text-xs font-medium uppercase tracking-wide text-zinc-500">
                                <tr>
                                    <th scope="col" class="px-5 py-3">#</th>
                                    <th scope="col" class="px-5 py-3">Nome</th>
                                    <th scope="col" class="px-5 py-3">Participantes</th>
                                    <th scope="col" class="px-5 py-3 text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 bg-white">
                                @foreach($events as $event)
                                    <tr class="transition-colors duration-300 hover:bg-zinc-50">
                                        <td scope="row" class="px-5 py-4 text-zinc-400">{{ $loop->index + 1 }}</td>
                                        <td class="px-5 py-4">
                                            <a href="{{ route('events.show', $event) }}"
                                               class="font-medium text-zinc-900 transition-colors duration-300 hover:text-accent">
                                                {{ $event->title }}
                                            </a>
                                        </td>
                                        <td class="px-5 py-4 text-zinc-500">{{ $event->users_count }}</td>
                                        <td class="px-5 py-4">
                                            <div class="flex items-center justify-end gap-1">
                                                <a href="{{ route('events.edit', $event) }}"
                                                   aria-label="Editar {{ $event->title }}"
                                                   class="flex h-9 w-9 items-center justify-center rounded-full text-zinc-500 transition-colors duration-300 hover:bg-zinc-100 hover:text-accent focus:outline-none focus-visible:ring-2 focus-visible:ring-accent">
                                                    <ion-icon name="create-outline" class="text-lg" aria-hidden="true"></ion-icon>
                                                </a>
                                                <form action="{{ route('events.destroy', $event) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit"
                                                            aria-label="Deletar {{ $event->title }}"
                                                            class="flex h-9 w-9 items-center justify-center rounded-full text-zinc-500 transition-colors duration-300 hover:bg-red-50 hover:text-red-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-accent">
                                                        <ion-icon name="trash-outline" class="text-lg" aria-hidden="true"></ion-icon>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-zinc-200 px-6 py-16 text-center">
                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-zinc-100">
                            <ion-icon name="calendar-clear-outline" class="text-2xl text-zinc-400" aria-hidden="true"></ion-icon>
                        </div>
                        <h3 class="mt-6 text-lg font-semibold text-zinc-900">Você ainda não tem eventos</h3>
                        <p class="mt-2 max-w-sm text-sm text-zinc-500">Crie o seu primeiro evento e comece a receber participantes.</p>
                        <a href="{{ route('events.create') }}"
                           class="mt-6 rounded-full bg-accent px-5 py-2.5 text-sm font-medium text-white shadow-sm transition-all duration-300 ease-out hover:bg-accent-hover hover:shadow-md">
                            Crie já
                        </a>
                    </div>
                @endif
            </div>

            <div>
                <h2 class="mb-6 text-2xl font-semibold tracking-tight text-zinc-900">Eventos que participo</h2>

                @if(count($eventsAsParticipants) > 0)
                    <div class="overflow-hidden rounded-2xl border border-zinc-100 shadow-sm">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-zinc-50 text-xs font-medium uppercase tracking-wide text-zinc-500">
                                <tr>
                                    <th scope="col" class="px-5 py-3">#</th>
                                    <th scope="col" class="px-5 py-3">Nome</th>
                                    <th scope="col" class="px-5 py-3">Participantes</th>
                                    <th scope="col" class="px-5 py-3 text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-100 bg-white">
                                @foreach($eventsAsParticipants as $event)
                                    <tr class="transition-colors duration-300 hover:bg-zinc-50">
                                        <td scope="row" class="px-5 py-4 text-zinc-400">{{ $loop->index + 1 }}</td>
                                        <td class="px-5 py-4">
                                            <a href="{{ route('events.show', $event) }}"
                                               class="font-medium text-zinc-900 transition-colors duration-300 hover:text-accent">
                                                {{ $event->title }}
                                            </a>
                                        </td>
                                        <td class="px-5 py-4 text-zinc-500">{{ $event->users_count }}</td>
                                        <td class="px-5 py-4 text-right">
                                            <form action="{{ route('events.leave', $event) }}" method="POST" class="inline-flex">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit"
                                                        class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-sm font-medium text-zinc-500 transition-colors duration-300 hover:bg-red-50 hover:text-red-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-accent">
                                                    <ion-icon name="exit-outline" aria-hidden="true"></ion-icon>
                                                    Sair do evento
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-zinc-200 px-6 py-16 text-center">
                        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-zinc-100">
                            <ion-icon name="people-outline" class="text-2xl text-zinc-400" aria-hidden="true"></ion-icon>
                        </div>
                        <h3 class="mt-6 text-lg font-semibold text-zinc-900">Você ainda não está participando de nenhum evento</h3>
                        <p class="mt-2 max-w-sm text-sm text-zinc-500">Explore os eventos disponíveis e confirme presença.</p>
                        <a href="{{ route('events.index') }}"
                           class="mt-6 rounded-full bg-accent px-5 py-2.5 text-sm font-medium text-white shadow-sm transition-all duration-300 ease-out hover:bg-accent-hover hover:shadow-md">
                            Veja todos os eventos
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
