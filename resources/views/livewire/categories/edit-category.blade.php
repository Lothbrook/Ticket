<div class="max-w-xl">
    <div class="mb-5 text-2xl font-bold">Modifier Catégorie</div>
    <form wire:submit="save" class="space-y-5">
        <div>
            <label for="name"
                class="mb-1 block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Désignation</label>
            <input type="text" id="name" wire:model="name" @class([
                'block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50',
                'border-red-300 focus:border-red-300 focus:ring-red-200' => $errors->has(
                    'name'),
            ])
                placeholder="Désignation" />
            @error('name')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror

        </div>
        <button type="submit"
            class="rounded-lg border border-blue-950 bg-blue-950 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-blue-700 hover:bg-blue-700 focus:ring focus:ring-blue-200 disabled:cursor-not-allowed disabled:border-blue-300 disabled:bg-blue-300">
            Sauvegarder
        </button>
    </form>
</div>
