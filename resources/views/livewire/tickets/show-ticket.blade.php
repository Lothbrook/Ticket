<div x-data="{ isShowingLogs: false, isShowingComments: true }">
    <x-status />
    <div class="mb-5 text-2xl font-bold">Informations sur le Ticket </div>
    <div class="rounded-lg border border-gray-200 bg-white shadow-md">
        <div class="grid grid-cols-6 gap-6 p-4">
            <div class="font-bold">Titre</div>
            <div class="col-span-5">{{ ucfirst($ticket->title) }}</div>
            <div class="font-bold">Status</div>
            <div class="col-span-5">
                @if ($ticket->status === 'closed')
                    <span
                        class="inline-flex items-center gap-1 rounded-full bg-green-200 px-2 py-1 text-sm font-semibold text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                            <path fill-rule="evenodd"
                                d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ ucfirst($ticket->status) }}
                    </span>
                @else
                    <span class="inline-flex items-center text-sm font-semibold text-red-600">
                        {{ ucfirst($ticket->status) }}
                    </span>
                @endif
            </div>
            <div class="font-bold">Priorité</div>
            <div class="col-span-5">
                <span @class([
                    'inline-flex items-center gap-1 rounded-full px-2 py-1 text-xs font-semibold',
                    'bg-green-200 text-green-700' => $ticket->priority === 'low',
                    'bg-yellow-200 text-yellow-700' => $ticket->priority === 'medium',
                    'bg-red-200 text-red-700' => $ticket->priority === 'high',
                ])>
                    @php
                        $priorityFr = match($ticket->priority) {
                            'low' => 'Faible',
                            'medium' => 'Moyen',
                            'high' => 'Élevé',
                        };
                    @endphp
                    {{ $priorityFr }}
                </span>
            </div>
            <div class="font-bold">Description</div>
            <div class="col-span-5">{{ $ticket->description }}</div>
            <div class="font-bold">Catégories</div>
            <div class="col-span-5">
                @foreach ($ticket->categories as $category)
                    <span class="rounded-full bg-blue-200 px-2 py-1 text-xs text-blue-800">{{ $category->name }}</span>
                @endforeach
            </div>
            <div class="font-bold">Étiquettes</div>
            <div class="col-span-5">
                @foreach ($ticket->labels as $label)
                    <span
                        class="rounded-full bg-orange-200 px-2 py-1 text-xs text-orange-800">{{ $label->name }}</span>
                @endforeach
            </div>
            <div class="font-bold">Créé par</div>
            <div class="col-span-5">{{ $ticket->user->name }}</div>
            <div class="font-bold">Agent assigné</div>
            <div class="col-span-5">{{ $ticket->agent->name ?? '' }}</div>
            <div class="font-bold">Pièce(s) jointe(s)</div>
            <div class="col-span-5">
                @foreach ($ticket->getMedia('attachments') as $attachment)
                    <a href="{{ $attachment->getUrl() }}"
                        class="text-blue-600 hover:underline">{{ $attachment->file_name }}</a>
                    @if ($loop->iteration !== $loop->count)
                        ,
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="flex gap-5">
        <button @click="isShowingLogs = !isShowingLogs" x-text="isShowingLogs ? 'Masquer les logs' : 'Afficher les logs'"
            class="mt-4 rounded-lg border border-blue-950 bg-blue-950 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-blue-700 hover:bg-blue-700 focus:ring focus:ring-blue-200 disabled:cursor-not-allowed disabled:border-blue-300 disabled:bg-blue-300">
        </button>
        <button @click="isShowingComments = !isShowingComments"
            x-text="isShowingComments ? 'Masquer les commentaires' : 'Affichers les commentaires'"
            class="mt-4 rounded-lg border border-blue-950 bg-blue-950 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-blue-700 hover:bg-blue-700 focus:ring focus:ring-blue-200 disabled:cursor-not-allowed disabled:border-blue-300 disabled:bg-blue-300">
        </button>
    </div>
    <div x-show="isShowingComments" wire:transition>
        <livewire:comments.show-comments :ticket="$ticket" />
    </div>
    <div x-show="isShowingLogs" wire:transition>
        <livewire:activity-logs.show-logs :ticket="$ticket" />
    </div>
</div>
