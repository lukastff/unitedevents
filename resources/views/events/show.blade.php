@extends("layouts.main")

@section("title", $event->title)

@section("content")
    <div id="image-container" class="h-[45vh] w-full overflow-hidden bg-zinc-100 sm:h-[55vh]">
        <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="h-full w-full object-cover"/>
    </div>

    <section class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-12 py-12 lg:grid-cols-3 lg:gap-16 lg:py-16">
            <div id="info-container" class="lg:col-span-2">
                <h1 class="text-4xl font-semibold tracking-tight text-zinc-900 sm:text-5xl">
                    {{ $event->title }}
                </h1>

                <div class="mt-6 flex flex-wrap items-center gap-x-6 gap-y-3 text-sm text-zinc-500">
                    <div class="flex items-center gap-1.5">
                        <ion-icon name="location-outline" class="text-base" aria-hidden="true"></ion-icon>
                        {{ $event->city }}
                    </div>
                    <div class="flex items-center gap-1.5">
                        <ion-icon name="people-outline" class="text-base" aria-hidden="true"></ion-icon>
                        {{ $event->users_count }} participantes
                    </div>
                    <div class="flex items-center gap-1.5">
                        <ion-icon name="star-outline" class="text-base" aria-hidden="true"></ion-icon>
                        Organizado por {{ $event->user->name }}
                    </div>
                </div>

                <div id="description-container" class="mt-10 border-t border-zinc-100 pt-10">
                    <h3 class="text-lg font-semibold tracking-tight text-zinc-900">Sobre o evento</h3>
                    <p class="mt-4 whitespace-pre-line text-base leading-relaxed text-zinc-600">{{ $event->description }}</p>
                </div>

                @if(count($event->items) > 0)
                    <div class="mt-10 border-t border-zinc-100 pt-10">
                        <h3 class="text-lg font-semibold tracking-tight text-zinc-900">O evento conta com</h3>
                        <ul id="items-list" class="mt-4 flex flex-wrap gap-2">
                            @foreach($event->items as $item)
                                <li class="inline-flex items-center gap-1.5 rounded-full border border-zinc-200 bg-zinc-50 px-4 py-2 text-sm text-zinc-600">
                                    <ion-icon name="checkmark-outline" class="text-base text-accent" aria-hidden="true"></ion-icon>
                                    <span>{{ $item }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-24 rounded-2xl border border-zinc-100 p-6 shadow-sm">
                    <p class="text-sm font-medium text-zinc-500">Presença confirmada</p>
                    <p class="mt-1 text-3xl font-semibold tracking-tight text-zinc-900">{{ $event->users_count }}</p>

                    @if(!$hasUserJoined)
                        <form action="{{ route('events.join', $event) }}" method="POST" class="mt-6">
                            @csrf
                            <a href="{{ route('events.join', $event) }}"
                               id="event-submit"
                               onclick="event.preventDefault(); this.closest('form').submit();"
                               class="block w-full rounded-full bg-accent px-6 py-3.5 text-center text-sm font-medium text-white shadow-sm transition-all duration-300 ease-out hover:bg-accent-hover hover:shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-accent focus-visible:ring-offset-2"
                            >
                                Confirmar presença
                            </a>
                        </form>
                    @else
                        <div class="mt-6 flex items-center gap-2 rounded-full bg-accent/10 px-4 py-3 text-sm font-medium text-accent">
                            <ion-icon name="checkmark-circle-outline" class="text-lg" aria-hidden="true"></ion-icon>
                            Você já está participando deste evento!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
