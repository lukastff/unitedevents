@extends("layouts.main")

@section("title", "Editando " . $event->title)

@section("content")
    <div id="event-create-container">
        <h1>Editando: {{ $event->title }}</h1>
        <form action="/events/update/{{ $event->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div>
                <label for="image">Imagem do Evento:</label>
                <input type="file" id="image" name="image" placeholder="Nome do evento" />
                <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
            </div>
            <div>
                <label for="title">Evento:</label>
                <input type="text" id="title" name="title" placeholder="Nome do evento" value="{{ $event->title }}" />
            </div>
            <div>
                <label for="date">Data do evento:</label>
                <input type="date" id="date" name="date" value="{{ $event->date->format('Y-m-d') }}" />
            </div>
            <div>
                <label for="city">Cidade:</label>
                <input type="text" id="city" name="city" placeholder="Local do evento" value="{{ $event->city }}" />
            </div>
            <div>
                <label for="private">O evento é privado?</label>
                <select name="private" id="private">
                    <option value="0">Não</option>
                    <option value="1" {{ $event->private == 1 ? "selected='selected'" : ""}}>Sim</option>
                </select>
            </div>
            <div>
                <label for="description">Descrição:</label>
                <textarea id="description" name="description" placeholder="O'que vai acontecer no evento">{{ $event->description }}</textarea>
            </div>
            <div>
                <label for="description">Adicione itens de infraestutura:</label>
                <div>
                    <input type="checkbox" name="items[]" value="Cadeiras"/> Cadeirdas
                </div>
                <div>
                    <input type="checkbox" name="items[]" value="Palco"/> Palco
                </div>
                <div>
                    <input type="checkbox" name="items[]" value="Cerveja grátis"/> Cerveja grátis
                </div>
                <div>
                    <input type="checkbox" name="items[]" value="Open Food"/> Open Food
                </div>
                <div>
                    <input type="checkbox" name="items[]" value="Brindes"/> Brindes
                </div>
            </div>
            <input type="submit" value="Editar Evento" />
        </form>
    </div>
@endsection
