@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')
    <div id="event-create-container">
        <h1>Crie o seu evento</h1>
        <form action="/events" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="image">Imagem do Evento:</label>
                <input type="file" id="image" name="image" placeholder="Nome do evento" />
            </div>
            <div>
                <label for="title">Evento:</label>
                <input type="text" id="title" name="title" placeholder="Nome do evento" />
            </div>
            <div>
                <label for="city">Cidade:</label>
                <input type="text" id="city" name="city" placeholder="Local do evento" />
            </div>
            <div>
                <label for="private">O evento é privado?</label>
                <select name="private" id="private">
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </div>
            <div>
                <label for="description">Descrição:</label>
                <textarea id="description" name="description" placeholder="O'que vai acontecer no evento"></textarea>
            </div>
            <input type="submit" value="Criar Evento" />
        </form>
    </div>
@endsection
