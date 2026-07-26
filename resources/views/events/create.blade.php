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

        <form action="/events" method="POST" enctype="multipart/form-data" class="mt-12 space-y-8">
            @csrf

            <div>
                <label for="image" class="mb-2 block text-sm font-medium text-zinc-700">Imagem do evento</label>
                <input type="file" id="image" name="image"
                       class="block w-full text-sm text-zinc-500 file:mr-4 file:rounded-full file:border-0 file:bg-accent file:px-5 file:py-2.5 file:text-sm file:font-medium file:text-white file:transition-colors file:duration-300 hover:file:bg-accent-hover focus:outline-none focus-visible:ring-2 focus-visible:ring-accent focus-visible:ring-offset-2 rounded-full" />
            </div>

            <div>
                <label for="title" class="mb-2 block text-sm font-medium text-zinc-700">Evento</label>
                <input type="text" id="title" name="title" placeholder="Nome do evento"
                       class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 shadow-sm transition-all duration-300 ease-out placeholder:text-zinc-400 focus:border-accent focus:bg-white focus:outline-none focus:ring-2 focus:ring-accent/30" />
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <label for="date" class="mb-2 block text-sm font-medium text-zinc-700">Data do evento</label>
                    <input type="date" id="date" name="date"
                           class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 shadow-sm transition-all duration-300 ease-out focus:border-accent focus:bg-white focus:outline-none focus:ring-2 focus:ring-accent/30" />
                </div>
                <div>
                    <label for="city" class="mb-2 block text-sm font-medium text-zinc-700">Cidade</label>
                    <input type="text" id="city" name="city" placeholder="Local do evento"
                           class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 shadow-sm transition-all duration-300 ease-out placeholder:text-zinc-400 focus:border-accent focus:bg-white focus:outline-none focus:ring-2 focus:ring-accent/30" />
                </div>
            </div>

            <div>
                <label for="private" class="mb-2 block text-sm font-medium text-zinc-700">O evento é privado?</label>
                <select name="private" id="private"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 shadow-sm transition-all duration-300 ease-out focus:border-accent focus:bg-white focus:outline-none focus:ring-2 focus:ring-accent/30">
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </div>

            <div>
                <label for="description" class="mb-2 block text-sm font-medium text-zinc-700">Descrição</label>
                <textarea id="description" name="description" rows="5" placeholder="O que vai acontecer no evento"
                          class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 text-sm text-zinc-900 shadow-sm transition-all duration-300 ease-out placeholder:text-zinc-400 focus:border-accent focus:bg-white focus:outline-none focus:ring-2 focus:ring-accent/30"></textarea>
            </div>

            <fieldset>
                <legend class="mb-3 block text-sm font-medium text-zinc-700">Adicione itens de infraestrutura</legend>
                <div class="flex flex-wrap gap-2">
                    <label class="group cursor-pointer">
                        <input type="checkbox" name="items[]" value="Cadeiras" class="peer sr-only" />
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-zinc-200 bg-zinc-50 px-4 py-2 text-sm text-zinc-600 transition-all duration-300 ease-out peer-checked:border-accent peer-checked:bg-accent/10 peer-checked:text-accent peer-focus-visible:ring-2 peer-focus-visible:ring-accent peer-focus-visible:ring-offset-2">
                            <ion-icon name="checkmark-outline" class="hidden text-base group-has-[:checked]:inline" aria-hidden="true"></ion-icon>
                            Cadeiras
                        </span>
                    </label>
                    <label class="group cursor-pointer">
                        <input type="checkbox" name="items[]" value="Palco" class="peer sr-only" />
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-zinc-200 bg-zinc-50 px-4 py-2 text-sm text-zinc-600 transition-all duration-300 ease-out peer-checked:border-accent peer-checked:bg-accent/10 peer-checked:text-accent peer-focus-visible:ring-2 peer-focus-visible:ring-accent peer-focus-visible:ring-offset-2">
                            <ion-icon name="checkmark-outline" class="hidden text-base group-has-[:checked]:inline" aria-hidden="true"></ion-icon>
                            Palco
                        </span>
                    </label>
                    <label class="group cursor-pointer">
                        <input type="checkbox" name="items[]" value="Cerveja grátis" class="peer sr-only" />
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-zinc-200 bg-zinc-50 px-4 py-2 text-sm text-zinc-600 transition-all duration-300 ease-out peer-checked:border-accent peer-checked:bg-accent/10 peer-checked:text-accent peer-focus-visible:ring-2 peer-focus-visible:ring-accent peer-focus-visible:ring-offset-2">
                            <ion-icon name="checkmark-outline" class="hidden text-base group-has-[:checked]:inline" aria-hidden="true"></ion-icon>
                            Cerveja grátis
                        </span>
                    </label>
                    <label class="group cursor-pointer">
                        <input type="checkbox" name="items[]" value="Open Food" class="peer sr-only" />
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-zinc-200 bg-zinc-50 px-4 py-2 text-sm text-zinc-600 transition-all duration-300 ease-out peer-checked:border-accent peer-checked:bg-accent/10 peer-checked:text-accent peer-focus-visible:ring-2 peer-focus-visible:ring-accent peer-focus-visible:ring-offset-2">
                            <ion-icon name="checkmark-outline" class="hidden text-base group-has-[:checked]:inline" aria-hidden="true"></ion-icon>
                            Open Food
                        </span>
                    </label>
                    <label class="group cursor-pointer">
                        <input type="checkbox" name="items[]" value="Brindes" class="peer sr-only" />
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-zinc-200 bg-zinc-50 px-4 py-2 text-sm text-zinc-600 transition-all duration-300 ease-out peer-checked:border-accent peer-checked:bg-accent/10 peer-checked:text-accent peer-focus-visible:ring-2 peer-focus-visible:ring-accent peer-focus-visible:ring-offset-2">
                            <ion-icon name="checkmark-outline" class="hidden text-base group-has-[:checked]:inline" aria-hidden="true"></ion-icon>
                            Brindes
                        </span>
                    </label>
                </div>
            </fieldset>

            <input type="submit" value="Criar Evento"
                   class="w-full cursor-pointer rounded-full bg-accent px-6 py-3.5 text-sm font-medium text-white shadow-sm transition-all duration-300 ease-out hover:bg-accent-hover hover:shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-accent focus-visible:ring-offset-2 sm:w-auto" />
        </form>
    </section>
@endsection
