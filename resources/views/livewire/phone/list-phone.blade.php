<div x-data="{ 
    openDropdown: null, 
    toggleDropdown(id) { 
        this.openDropdown = this.openDropdown === id ? null : id; 
    } 
}">
    <!-- Status message -->
    <x-status />

    <div class="mb-5 text-2xl font-bold text-gray-700">Gestion de Stock de Téléphones</div>

    <!-- Add Phone Button -->
    <div class="mt-8 mb-6">
        <a href="{{ route('phone.create') }}"
            class="inline-flex items-center rounded-full bg-blue-950 px-6 py-3 text-white text-sm font-medium shadow-xl hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:bg-blue-700 hover:scale-105">
            <i class="fas fa-plus-circle mr-3"></i>&nbsp; Créer un Téléphone
        </a>
    </div>

    <!-- Filter Section (Aligned in a single row) -->
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-xl mb-8 bg-white p-4">
        <div class="flex flex-wrap items-center gap-4">
            <!-- Société Filter -->
            <div class="w-full sm:w-auto">
                <select wire:model.live="societeFilter" id="societeFilter" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    <option value="">- Sélectionner une Société -</option>
                    @foreach ($societes as $societe)
                        <option value="{{ $societe->id }}">{{ $societe->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Catégorie Filter -->
            <div class="w-full sm:w-auto">
                <select wire:model.live="categoryFilter"
                        class="w-full rounded-lg border-gray-300 focus:ring-primary-300 focus:border-primary-500 py-3 px-4 transition-all duration-300 ease-in-out shadow-sm">
                    <option value="">- Sélectionner une Catégorie -</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->nom_categorie }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Search Section -->
            <div class="w-full sm:w-auto flex-grow">
                <input type="text" wire:model.live="search"
                    class="w-full rounded-lg border-gray-300 focus:ring-primary-300 focus:border-primary-500 py-3 px-4 transition-all duration-300 ease-in-out shadow-sm"
                    placeholder="Recherche..." />
            </div>
        </div>
    </div>

    <!-- Table of Phones -->
    <div class="relative rounded-lg border border-gray-200 shadow-lg overflow-visible">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-600">
            <thead class="bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-500">Equipement</th>
                    <th scope="col" class="px-3 py-4 font-medium text-gray-500">Date d'achat</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-500">Marque</th>
                    <th scope="col" class="px-3 py-4 font-medium text-gray-500">N° Série</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-500">Utilisateur</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-500">Société</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-500">Département</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($phones as $phone)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            <a href="{{ route('phone.show', $phone) }}" class="text-blue-600 hover:text-blue-800">
                                {{ strtoupper($phone->name) }}
                            </a>
                        </td>
                        <td class="px-6 py-4">{{ $phone->date_achat }}</td>
                        <td class="px-6 py-4">{{ $phone->marque }}</td>
                        <td class="px-6 py-4">{{ $phone->serie }}</td>
                        <td class="px-6 py-4">{{ $phone->user->name ?? 'Non attribué' }}</td>
                        <td class="px-6 py-4">{{ $phone->societe->name ?? 'Non définie' }}</td>
                        <td class="px-6 py-4">{{ $phone->departement->nom_departement ?? 'Non attribué' }}</td>
                        <td class="px-6 py-4">
                            <!-- Dropdown button for actions -->
                            <div class="relative">
                                <button @click="toggleDropdown({{ $phone->id }})"
                                    class="rounded-full bg-blue-600 px-4 py-1 text-white hover:bg-blue-500">
                                    Actions
                                </button>

                                <!-- Dropdown content -->
                                <div x-show="openDropdown === {{ $phone->id }}" 
                                    @click.away="openDropdown = null"
                                    class="absolute right-0 mt-2 w-48 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 z-50">
                                    <a href="{{ route('phone.edit', $phone) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    <a href="{{ route('phone.generateWord', $phone->id) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-print"></i> Mise en service
                                    </a>
                                    <button wire:click="deletePhone({{ $phone->id }})"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-trash-alt"></i> Supprimer
                                    </button>
                                    <button wire:click="archivePhone({{ $phone->id }})"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-archive"></i> Archiver
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="bg-white p-4">
            {{ $phones->links() }}
        </div>
    </div>
</div>
