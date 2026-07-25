@extends("layouts.main")

@section("title", $event->title)

@section("content")
    <div>
        <div>
            <div id="image-container">
                <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}"/>
            </div>
            <div id="info-container">
                <h1>{{ $event->title }}</h1>
                <p>
                    <ion-icon name="location-outline"></ion-icon>
                    {{ $event->city }}
                </p>
                <p>
                    <ion-icon name="people-outline"></ion-icon>
                    X Participantes
                </p>
                <p>
                    <ion-icon name="star-outline"></ion-icon>
                    Dono do Evento
                </p>
                <a href="#" id="event-submit">Confirmar Presença</a>
            </div>
            <div id="description-container">
                <h3>Sobre o evento:</h3>
                <p>{{ $event->description }}</p>
            </div>
        </div>
    </div>
@endsection
