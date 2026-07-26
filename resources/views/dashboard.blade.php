@extends("layouts.main")

@section("title", "Dashboard")

@section("content")
    <div>
        <h1>Meus Eventos</h1>
    </div>
    <div>
        @if(count($events) > 0)
        @else
            <p>Você ainda não tem eventos, <a href="/events/create">Crie já</a></p>
        @endif
    </div>
@endsection
