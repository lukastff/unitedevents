@extends("layouts.main")

@section("title", "Dashboard")

@section("content")
    <div>
        <h1>Meus Eventos</h1>
    </div>
    <div>
        @if(count($events) > 0)
            <table>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Participantes</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td scropt="row">{{ $loop->index + 1 }}</td>
                            <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                            <td>0</td>
                            <td><a href="#">Editar</a> <a href="#">Deletar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você ainda não tem eventos, <a href="/events/create">Crie já</a></p>
        @endif
    </div>
@endsection
