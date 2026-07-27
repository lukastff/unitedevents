@php
    $availableItems = ['Cadeiras', 'Palco', 'Cerveja grátis', 'Open Food', 'Brindes'];
@endphp

<fieldset>
    <legend class="mb-3 block text-sm font-medium text-zinc-700">Adicione itens de infraestrutura</legend>
    <div class="flex flex-wrap gap-2">
        @foreach($availableItems as $item)
            <label class="group cursor-pointer">
                <input type="checkbox" name="items[]" value="{{ $item }}" class="peer sr-only"
                       @checked(in_array($item, $selectedItems)) />
                <span class="inline-flex items-center gap-1.5 rounded-full border border-zinc-200 bg-zinc-50 px-4 py-2 text-sm text-zinc-600 transition-all duration-300 ease-out peer-checked:border-accent peer-checked:bg-accent/10 peer-checked:text-accent peer-focus-visible:ring-2 peer-focus-visible:ring-accent peer-focus-visible:ring-offset-2">
                    <ion-icon name="checkmark-outline" class="hidden text-base group-has-[:checked]:inline" aria-hidden="true"></ion-icon>
                    {{ $item }}
                </span>
            </label>
        @endforeach
    </div>
</fieldset>
