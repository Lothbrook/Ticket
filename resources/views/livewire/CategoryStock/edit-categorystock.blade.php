<div class="max-w-xl">
    <div class="mb-5 text-2xl font-bold">Modifier catégorie de stock</div>
    <form wire:submit.prevent="save" class="space-y-5">
        <div>
            <label for="nom_category"
                class="mb-1 block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Nom de Categorie</label>
            <input type="text" id="nom_category" wire:model="nom_category" @class([
                'block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50',
                'border-red-300 focus:border-red-300 focus:ring-red-200' => $errors->has('nom_category'),
            ]) placeholder="Nom de catégorie" />
            @error('nom_category')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="type" class="mb-1 block text-sm font-medium text-gray-700">Type</label>
            <select id="type" wire:model="type" class="block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">Type</option>
                <option value="pc">PC</option>
                <option value="phone">Téléphone</option>
            </select>
        </div>

        <button type="submit"
            class="rounded-lg border border-blue-950 bg-blue-950 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-blue-700 hover:bg-blue-700 focus:ring focus:ring-blue-200 disabled:cursor-not-allowed disabled:border-blue-300 disabled:bg-blue-300">
            Mettre à jour
        </button>
    </form>
</div>
