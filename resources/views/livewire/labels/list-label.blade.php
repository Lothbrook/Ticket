<div>
    <x-status />
    <div class="mb-5 text-2xl font-bold">Labels</div>
    <div class="mt-8">
        <a href="{{ route('labels.create') }}"
            class="rounded-lg border border-blue-950 bg-blue-950 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-blue-700 hover:bg-blue-700 focus:ring focus:ring-blue-200 disabled:cursor-not-allowed disabled:border-blue-300 disabled:bg-blue-300">
            Ajouter Label
        </a>
    </div>
    <br>
    <div class="max-w-2xl overflow-hidden rounded-lg border border-gray-200 shadow-md">
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-400">Nom</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-400"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @foreach ($labels as $label)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $label->name }}</td>
                        <td class="flex justify-end gap-4 px-6 py-4 font-medium">
                            <a href="{{ route('labels.edit', $label) }}"
                                class="rounded-full bg-blue-400 px-4 py-1 text-blue-800 hover:bg-blue-500 hover:text-white">Edit</a>
                            <button wire:confirm="Are you sure you want to delete this label?"
                                wire:click="deleteLabel({{ $label }})"
                                class="rounded-full bg-red-400 px-4 py-1 text-red-800 hover:bg-red-500 hover:text-white">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="bg-white p-4">{{ $labels->links() }}</div>
    </div>

    

</div>
