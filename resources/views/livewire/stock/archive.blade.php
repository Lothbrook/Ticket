<div x-data="{ 
        openExportModal: false, 
        openArchiveModal: false, 
        selectedStockId: null 
    }">
        <x-status />
        <div class="mb-5 text-2xl font-bold">Gestion de Stock de Matériel Archivé</div>
        
        <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
            <div class="flex justify-between bg-white">
                <div class="flex">
                    <!-- Vos filtres ici -->    
                </div>
            </div>
            <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-400"></th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-400">Nom</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-400">Date d'achat</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-400">Prix d'achat</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-400">Prix de vente</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-400">Société</th>
                        <th scope="col" class="px-6 py-4 font-medium text-gray-400">Utilisateur</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                    @foreach ($stocks as $stock)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900"><i class="fa-solid fa-desktop"></i></td>
                            <td class="px-6 py-4 font-medium text-gray-900">
                                <a href="{{ route('stock.show', $stock) }}" class="text-blue-700 hover:text-blue-900">
                                    {{ strtoupper($stock->name_composant) }}
                                </a>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $stock->date_achat }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ number_format($stock->prix_achat,02) }} DH</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ number_format($stock->valeur_actuelle,2) }} DH</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $stock->societe->name }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $stock->user->name ?? 'Utilisateur non définie'}}</td>
                        </tr>
                    @endforeach
                    @foreach ($phone as $phones)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900"><i class="fa-solid fa-mobile-button"></i></td>
                            <td class="px-6 py-4 font-medium text-gray-900">
                                <a href="{{ route('phone.show', $phones) }}" class="text-blue-700 hover:text-blue-900">
                                    {{ strtoupper($phones->name) }}
                                </a>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $phones->date_achat }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ number_format($phones->prix_achat,2) }} DH</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ number_format($phones->valeur_actuelle,2) }} DH</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $phones->societe->name }}</td>
                            <td class="px-3 py-4 font-medium text-gray-900">{{ $phones->user->name ?? 'Utilisateur non définie' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>

        
    </div>