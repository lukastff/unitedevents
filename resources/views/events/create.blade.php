@extends('layouts.main')

@section('title', 'Criar Evento')

@section('content')
    <section class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-semibold tracking-tight text-zinc-900 sm:text-5xl">
                Crie o seu evento
            </h1>
            <p class="mt-4 text-lg text-zinc-500">
                Preencha os detalhes abaixo para publicar seu evento.
            </p>
        </div>

        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="mt-12 space-y-8">
            @csrf

            <div>
                <label for="image" class="mb-2 block text-sm font-medium text-zinc-700">Imagem do evento</label>
                <input type="file" id="image" name="image" required
                       class="block w-full text-sm text-zinc-500 file:mr-4 file:rounded-full file:border-0 file:bg-accent file:px-5 file:py-2.5 file:text-sm file:font-medium file:text-white file:transition-colors file:duration-300 hover:file:bg-accent-hover focus:outline-none focus-visible:ring-2 focus-visible:ring-accent focus-visible:ring-offset-2 rounded-full" />
                @error('image')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="title" class="mb-2 block text-sm font-medium text-zinc-700">Evento</label>
                <input type="text" id="title" name="title" placeholder="Nome do evento" value="{{ old('title') }}" required
                       class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 shadow-sm transition-all duration-300 ease-out placeholder:text-zinc-400 focus:border-accent focus:bg-white focus:outline-none focus:ring-2 focus:ring-accent/30" />
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <label for="date" class="mb-2 block text-sm font-medium text-zinc-700">Data do evento</label>
                    <input type="date" id="date" name="date" value="{{ old('date') }}" required
                           class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 shadow-sm transition-all duration-300 ease-out focus:border-accent focus:bg-white focus:outline-none focus:ring-2 focus:ring-accent/30" />
                    @error('date')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="city" class="mb-2 block text-sm font-medium text-zinc-700">Cidade</label>
                    <input type="text" id="city" name="city" placeholder="Local do evento" value="{{ old('city') }}" required
                           class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 shadow-sm transition-all duration-300 ease-out placeholder:text-zinc-400 focus:border-accent focus:bg-white focus:outline-none focus:ring-2 focus:ring-accent/30" />
                    @error('city')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="private" class="mb-2 block text-sm font-medium text-zinc-700">O evento é privado?</label>
                <select name="private" id="private"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 shadow-sm transition-all duration-300 ease-out focus:border-accent focus:bg-white focus:outline-none focus:ring-2 focus:ring-accent/30">
                    <option value="0" @selected(old('private', '0') == '0')>Não</option>
                    <option value="1" @selected(old('private') == '1')>Sim</option>
                </select>
                @error('private')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="mb-2 block text-sm font-medium text-zinc-700">Descrição</label>
                <textarea id="description" name="description" rows="5" placeholder="O que vai acontecer no evento" required
                          class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 shadow-sm transition-all duration-300 ease-out placeholder:text-zinc-400 focus:border-accent focus:bg-white focus:outline-none focus:ring-2 focus:ring-accent/30">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            @include('events._items-fieldset', ['selectedItems' => old('items', [])])

            <input type="submit" value="Criar Evento"
                   class="w-full cursor-pointer rounded-full bg-accent px-6 py-3.5 text-sm font-medium text-white shadow-sm transition-all duration-300 ease-out hover:bg-accent-hover hover:shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-accent focus-visible:ring-offset-2 sm:w-auto" />
        </form>
    </section>
@endsection
