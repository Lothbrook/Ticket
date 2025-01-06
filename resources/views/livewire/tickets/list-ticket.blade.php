<div x-data="{
        openDropdown: null,
        toggleDropdown(id) {
            this.openDropdown = this.openDropdown === id ? null : id;
        },
    }">
    <x-status />
    <div class="mb-8 text-3xl font-semibold text-gray-800">Tickets</div>

    <!-- Button for creating tickets -->
    <div class="mt-8 mb-6">
        <a href="{{ route('tickets.create') }} "
            class="inline-flex items-center rounded-full bg-blue-950 px-6 py-3 text-white text-sm font-medium shadow-xl hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:bg-blue-700 hover:scale-105">
            <i class="fas fa-plus-circle mr-3"></i>&nbsp; Créer un ticket
        </a>
    </div>

    <!-- Filter Section (Aligned in a single row) -->
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-xl mb-8">
        <div class="flex flex-wrap gap-6 p-6 bg-white rounded-lg items-center">
            <!-- Category Filter -->
            <div class="w-full lg:w-1/4">
                <select wire:model.live="categoryFilter"
                    class="w-full rounded-lg border-gray-300 focus:ring-primary-300 focus:border-primary-500 py-3 px-4 transition-all duration-300 ease-in-out shadow-sm">
                    <option value="">- Sélectionner une Catégorie -</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <!-- Priority Filter -->
            <div class="w-full lg:w-1/4">
                <select wire:model.live="priorityFilter"
                    class="w-full rounded-lg border-gray-300 focus:ring-primary-300 focus:border-primary-500 py-3 px-4 transition-all duration-300 ease-in-out shadow-sm">
                    <option value="">- Sélectionner Priorité -</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
    
            <!-- Status Filter -->
            <div class="w-full lg:w-1/4">
                <select wire:model.live="statusFilter"
                    class="w-full rounded-lg border-gray-300 focus:ring-primary-300 focus:border-primary-500 py-3 px-4 transition-all duration-300 ease-in-out shadow-sm">
                    <option value="">- Sélectionner Status -</option>
                    <option value="open">Ouvert</option>
                    <option value="closed">Fermé</option>
                </select>
            </div>
    
            <!-- Search Input -->
            <div class="w-full lg:w-1/4">
                <input type="text" wire:model.live="search"
                    class="w-full rounded-lg border-gray-300 focus:ring-primary-300 focus:border-primary-500 py-3 px-4 transition-all duration-300 ease-in-out shadow-sm"
                    placeholder="Recherche..." />
            </div>
        </div>
    </div>


    <!-- Tickets Table -->
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md mb-8 max-h-96 overflow-y-auto">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-600 shadow-md rounded-lg">
            <thead class="bg-gradient-to-r from-blue-100 to-blue-200">
                <tr>
                    <th class="px-6 py-4 text-gray-400 font-medium">Titre</th>
                    <th class="px-6 py-4 text-gray-400 font-medium">Demandeur</th>
                    <th class="px-6 py-4 text-gray-400 font-medium">Priorité</th>
                    <th class="px-6 py-4 text-gray-400 font-medium">Status</th>
                    <th class="px-6 py-4 text-gray-400 font-medium">Assigné à</th>
                    <th class="px-6 py-4 text-gray-400 font-medium">Date de la demande</th>
                    <th class="px-6 py-4 text-gray-400 font-medium">Catégories</th>
                    <th class="px-6 py-4 text-gray-400 font-medium">Labels</th>
                    <th class="px-6 py-4 text-gray-400 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($tickets as $ticket)
                    <tr class="hover:bg-gray-50 transition-all duration-200 ease-in-out">
                        <td class="px-6 py-4 text-gray-900 font-medium">
                            <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-700 hover:text-blue-900 transition-all duration-300">
                                {{ \Illuminate\Support\Str::limit(strtoupper($ticket->title), 14) }}
                            </a>
                        </td>
                        <td class="px-6 py-4 text-gray-900">{{ $ticket->user->name }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-xs font-semibold"
                                :class="{
                                    'bg-green-200 text-green-700': '{{ $ticket->priority }}' === 'low',
                                    'bg-yellow-200 text-yellow-700': '{{ $ticket->priority }}' === 'medium',
                                    'bg-red-200 text-red-700': '{{ $ticket->priority }}' === 'high'
                                }">
                                {{ strtoupper($ticket->priority) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if ($ticket->status === 'closed')
                                <span class="text-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $ticket->agent->name ?? '' }}</td>
                        <td class="px-6 py-4">{{ $ticket->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4">
                            @foreach ($ticket->categories as $category)
                                <span class="inline-block bg-blue-400 text-white text-xs px-3 py-1 rounded-full">{{ $category->name }}</span>
                            @endforeach
                        </td>
                        <td class="px-6 py-4">
                            @foreach ($ticket->labels as $label)
                                <span class="inline-block bg-orange-400 text-white text-xs px-3 py-1 rounded-full">{{ $label->name }}</span>
                            @endforeach
                        </td>

                        <td class="px-6 py-4 text-right">
                            <!-- Actions Dropdown -->
                            <div class="relative">
                                <button @click="toggleDropdown({{ $ticket->id }})"
                                    class="inline-flex items-center rounded-full bg-blue-950 px-5 py-2 text-white text-sm hover:bg-blue-700 focus:ring focus:ring-blue-200 transition duration-300">
                                    <i class="fas fa-cogs"></i>
                                </button>
                                <div x-show="openDropdown === {{ $ticket->id }}" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform scale-75" x-transition:enter-end="opacity-100 transform scale-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100 transform scale-100"
                                    x-transition:leave-end="opacity-0 transform scale-75"
                                    @click.away="openDropdown = null"
                                    class="absolute right-0 mt-2 w-48 rounded-md bg-white shadow-lg z-50">
                                    @canany(['manage tickets', 'edit tickets'])
                                        <a href="{{ route('tickets.edit', $ticket) }}"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-300">
                                            <i class="fas fa-edit mr-2"></i> Modifier
                                        </a>
                                    @endcan
                                    @can('manage tickets')
                                        <button wire:click="deleteTicket({{ $ticket->id }})"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-300">
                                            <i class="fas fa-trash-alt mr-2"></i> Supprimer
                                        </button>
                                    @endcan
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="bg-white p-4">
            {{ $tickets->links() }}
        </div>
    </div>

</div>
