@extends('layouts.main')

@section('title', 'United Events')

@section('content')
    <div>
        <h1>Busque um evento</h1>
        <form action="/" method="GET">
            <input type="text" id="search" name="search" placeholder="Procurar...">
        </form>
    </div>
    <div id="events-container">
        @if($search)
            <h2>Buscando por: {{ $search }}</h2>
            @else
            <h2>Próximos Eventos</h2>
            <p>Veja os eventos dos próximos dias</p>
        @endif
        <div id="cards-container">
            @foreach($events as $event)
                <div>
                    <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" />
                    <div>
                        <p>{{ date("d/m/Y", strtotime($event->date)) }}</p>
                        <h5>{{ $event->title }}</h5>
                        <p>{{ count($event->users) }} Participantes</p>
                        <a href="/events/{{ $event->id }}">Saber mais</a>
                    </div>
                </div>
            @endforeach
            @if(count($events) === 0 && $search)
                <p>Não existe eventos disponíveis para a busca {{ $search }}! <a href="/">Ver todos</a></p>
                @elseif(count($events) === 0)
                <p>Não existe eventos disponíveis!</p>
            @endif
        </div>
    </div>
@endsection
