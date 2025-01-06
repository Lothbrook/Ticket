<div>
    <x-status />
    <div class="mb-5 text-2xl font-bold">Users</div>
    <div class="mt-8">
        <a href="{{ route('users.create') }}"
            class="rounded-lg border border-blue-950 bg-blue-950 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-blue-700 hover:bg-blue-700 focus:ring focus:ring-blue-200 disabled:cursor-not-allowed disabled:border-blue-300 disabled:bg-blue-300">
            Créé Utilisateur
        </a>
    </div>
    <br>
    <div class="max-w-5xl overflow-hidden rounded-lg border border-gray-200 shadow-md">
    <div class="flex justify-between bg-white">
            <div class="flex">
                <div class="flex items-center gap-2 p-4">
                    <select wire:model.live="societeFilter"
                        class="focus:border-primary-300 focus:ring-primary-200 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50">
                        <option value="">- Séléctionner une Société -</option>
                        @foreach ($societes as $societe)
                            <option value="{{ $societe->id }}">{{ $societe->name }}</option>
                        @endforeach
                    </select>
                </div>
                


            </div>
            <div class="flex items-center justify-end gap-2 p-4">
                <input type="text" wire:model.live="search"
                    class="focus:border-primary-400 focus:ring-primary-200 w-30 block rounded-md border-gray-300 shadow-sm focus:ring focus:ring-opacity-50"
                    placeholder="Search..." />
            </div>
        </div>
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-400">Nom Complet</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-400">Email</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-400">N° tel</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-400">Société</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-400"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $user->email }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $user->phone ?? 'Téléphone non définie' }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $user->societe->name ?? 'Société non définie' }}</td>
                        <td class="flex justify-end gap-4 px-6 py-4 font-medium">
                            <a href="{{ route('users.edit', $user) }}"
                                class="rounded-full bg-blue-400 px-4 py-1 text-blue-800 hover:bg-blue-500 hover:text-white">Edit</a>
                            <button
                                wire:confirm.prompt="Are you sure you want to delete this user?\n\nType DELETE to confirm|DELETE"
                                wire:click="deleteUser({{ $user }})"
                                class="rounded-full bg-red-400 px-4 py-1 text-red-800 hover:bg-red-500 hover:text-white">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="bg-white p-4">{{ $users->links() }}</div>
    </div>

    

</div>
