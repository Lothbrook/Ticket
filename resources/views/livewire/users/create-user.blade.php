<div class="max-w-xl">
    <div class="mb-5 text-2xl font-bold">Créé Utilisateur</div>
    <form wire:submit.prevent="save" class="space-y-5">
        <div>
            <label for="role"
                class="mb-1 block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Role</label>
            <select wire:model.defer="role"
                class="focus:border-primary-300 focus:ring-primary-200 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50">
                <option value="">--Select Role--</option>
                @foreach ($roles as $roleFound)
                    <option value="{{ $roleFound->id }}">{{ $roleFound->name }}</option>
                @endforeach
            </select>
            @error('role') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="name"
                class="mb-1 block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Nom Complet</label>
            <input type="text" id="name" wire:model.defer="name" @class([
                'block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50',
                'border-red-300 focus:border-red-300 focus:ring-red-200' => $errors->has(
                    'name'),
            ]) placeholder="Nom Complet" />
            @error('name')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="email"
                class="mb-1 block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Email</label>
            <input type="text" id="email" wire:model.defer="email" @class([
                'block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50',
                'border-red-300 focus:border-red-300 focus:ring-red-200' => $errors->has(
                    'email'),
            ])
                placeholder="a@b.com" />
            @error('email')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="phone"
                class="mb-1 block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Téléphone</label>
            <input type="text" id="phone" wire:model.defer="phone" @class([
                'block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50',
                'border-red-300 focus:border-red-300 focus:ring-red-200' => $errors->has(
                    'phone'),
            ])
                placeholder="06xxxxxxx" />
            @error('phone')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="password"
                class="mb-1 block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Mot de passe</label>
            <input type="password" id="password" wire:model.defer="password" @class([
                'block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50',
                'border-red-300 focus:border-red-300 focus:ring-red-200' => $errors->has(
                    'password'),
            ])
                placeholder="********" />
            @error('password')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="id_societe"
                class="mb-1 block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Société</label>
            <select wire:model.defer="id_societe"
                class="focus:border-primary-300 focus:ring-primary-200 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50">
                <option value="">--Select Société--</option>
                @foreach ($societes as $societe)
                    <option value="{{ $societe->id }}">{{ $societe->name }}</option>
                @endforeach
            </select>
            @error('id_societe') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
        </div>
        <button type="submit"
            class="rounded-lg border border-blue-950 bg-blue-950 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-blue-700 hover:bg-blue-700 focus:ring focus:ring-blue-200 disabled:cursor-not-allowed disabled:border-blue-300 disabled:bg-blue-300">
            Créé
        </button>
    </form>
</div>
