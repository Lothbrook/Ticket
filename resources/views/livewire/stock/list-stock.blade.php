<div x-data="{
    openExportModal: false, 
    openArchiveModal: false, 
    openDropdown: null, 
    allChecked: false,
    selectedStocks: [],
    selectedStockId: null,
    toggleAll() {
        this.allChecked = !this.allChecked;
        if (this.allChecked) {
            @this.set('selectedStocks', @json($stocks->pluck('id')));
        } else {
            @this.set('selectedStocks', []);
        }
    },
    toggleDropdown(id) {
        this.openDropdown = this.openDropdown === id ? null : id;
    },
    closeModals() {
        this.openExportModal = false;
        this.openArchiveModal = false;
    }
}">
    <!-- Status Message -->
    <x-status />

    <!-- Title -->
    <div class="mb-5 text-2xl font-bold text-gray-800">Gestion de Stock de Matériel</div>

    <!-- Buttons Section -->
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('stock.create') }}" 
           class="rounded-lg border border-blue-600 bg-blue-600 px-5 py-2.5 text-white font-medium shadow-md hover:bg-blue-500 transition">
            <i class="fas fa-plus-circle mr-2"></i> Créer un Stock
        </a>
        <button @click="openExportModal = true" 
                class="rounded-lg border border-green-500 bg-green-500 px-5 py-2.5 text-white font-medium shadow-md hover:bg-green-400 transition">
            <i class="fas fa-file-export mr-2"></i> Exporter
        </button>
    </div>

    <!-- Filters Section -->
    <div class="flex flex-wrap items-center gap-4 bg-white p-4 rounded-md shadow-sm">
        <div class="w-full md:w-1/3">
            <label for="societeFilter" class="block text-sm font-medium text-gray-700">Société</label>
            <select wire:model.live="societeFilter" id="societeFilter" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                <option value="">- Séléctionner une Société -</option>
                @foreach ($societes as $societe)
                    <option value="{{ $societe->id }}">{{ $societe->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-1/3">
            <label for="categoryFilter" class="block text-sm font-medium text-gray-700">Catégorie</label>
            <select wire:model.live="categoryFilter" id="categoryFilter" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                <option value="">- Séléctionner une Catégorie -</option>
                @foreach ($categorystock as $category)
                    <option value="{{ $category->id }}">{{ $category->nom_categorie }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-1/3">
            <label for="search" class="block text-sm font-medium text-gray-700">Rechercher</label>
            <input type="text" wire:model.live="search" id="search"
                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" 
                   placeholder="Rechercher un stock...">
        </div>
    </div>

    <!-- Table Section -->
    <div class="mt-6 rounded-lg border border-gray-200 shadow-md">
        <table class="w-full table-auto bg-white text-left text-sm text-gray-600">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-gray-400">
                        <input type="checkbox" @click="toggleAll()" />
                    </th>
                    <th class="px-6 py-3">Équipement</th>
                    <th class="px-6 py-3">Date d'achat</th>
                    <th class="px-6 py-3">Date M.E.Service</th>
                    <th class="px-6 py-3">Caractéristique</th>
                    <th class="px-6 py-3">Réf Interne</th>
                    <th class="px-6 py-3">Société</th>
                    <th class="px-6 py-3">Catégorie</th>
                    <th class="px-6 py-3">Utilisateur</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($stocks as $stock)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-3">
                            <input type="checkbox" wire:model="selectedStocks" value="{{ $stock->id }}" />
                        </td>
                        <td class="px-6 py-3">
                            <a href="{{ route('stock.show', $stock) }}" class="text-blue-600 hover:underline">
                                {{ strtoupper($stock->name_composant) }}
                            </a>
                        </td>
                        <td class="px-6 py-3">{{ $stock->date_achat }}</td>
                        <td class="px-6 py-3">{{ $stock->date_mise_en_service }}</td>
                        <td class="px-6 py-3">{{ $stock->caractere }} <br>{{ $stock->modele }} <br>{{ $stock->marque }}</td>
                        <td class="px-6 py-3">{{ $stock->id_equipement }}</td>
                        <td class="px-6 py-3">{{ $stock->societe->name ?? 'N/A' }}</td>
                        <td class="px-6 py-3">{{ $stock->categorystock->nom_categorie ?? 'N/A' }}</td>
                        <td class="px-6 py-3">{{ $stock->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-3 relative">
                            <div class="relative">
                                <button @click="toggleDropdown({{ $stock->id }})"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 transition">
                                    Actions
                                </button>
                                <div x-show="openDropdown === {{ $stock->id }}" 
                                     class="absolute z-50 mt-2 w-48 rounded-md bg-white shadow-lg">
                                    <a href="{{ route('stock.edit', $stock) }}" 
                                       class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-edit mr-2"></i> Modifier
                                    </a>
                                    <a href="{{ route('stock.generateWord', $stock->id) }}" 
                                       class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-print mr-2"></i> Mise en service
                                    </a>
                                    <button wire:click="deleteStock({{ $stock->id }})" 
                                            class="block w-full px-4 py-2 text-left text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-trash-alt mr-2"></i> Supprimer
                                    </button>
                                    <button @click="selectedStockId = {{ $stock->id }}; openArchiveModal = true"
                                        class="block w-full px-4 py-2 text-left text-gray-700 hover:bg-gray-100">
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
            {{ $stocks->links() }}
        </div>
    </div>

    <!-- Export Modal -->
    <div x-show="openExportModal" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="px-6 py-4">
                <h2 class="text-lg font-bold text-gray-800">Exporter les Stocks</h2>
                <p class="text-sm text-gray-600">Veuillez choisir les options d’exportation.</p>
            </div>
            <div class="px-6 py-4 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Format d’exportation</label>
                    <select class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="csv">CSV</option>
                        <option value="excel">Excel</option>
                    </select>
                </div>
            </div>
            <div class="px-6 py-4 flex justify-end space-x-4">
                <button @click="closeModals" 
                        class="rounded-md border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50">Annuler</button>
                <button class="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-500">Exporter</button>
            </div>
        </div>
    </div>

    <!-- Archive Confirmation Modal -->
    <div x-show="openArchiveModal" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="px-6 py-4">
                <h2 class="text-lg font-bold text-gray-800">Confirmer l'archivage</h2>
                <p class="text-sm text-gray-600">Êtes-vous sûr de vouloir archiver les stocks sélectionnés ?</p>
            </div>
            <div class="px-6 py-4 flex justify-end space-x-4">
                <button @click="closeModals" 
                        class="rounded-md border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50">Annuler</button>
                <button @click="closeModals; $wire.archiveStock(selectedStockId)"
                        class="rounded-md bg-red-600 px-4 py-2 text-white hover:bg-red-500">Confirmer</button>
            </div>
        </div>
    </div>
</div>
