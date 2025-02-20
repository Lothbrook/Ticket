<div>
    @if ($ticket->status === 'open')
        <div class="mt-4">
            <form wire:submit="save">
                <label for="newComment"
                    class="mb-1 block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">
                    Nouveau commentaire
                </label>
                <textarea id="newComment" wire:model="newComment" rows="5" @class([
                    'block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50',
                    'border-red-300 focus:border-red-300 focus:ring-red-200' => $errors->has(
                        'newComment'),
                ])
                    placeholder="Laissez un commentaire sur ce ticket..."></textarea>
                @error('newComment')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                <button type="submit"
                    class="mt-4 rounded-lg border border-blue-950 bg-blue-950 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-blue-700 hover:bg-blue-700 focus:ring focus:ring-blue-200 disabled:cursor-not-allowed disabled:border-blue-300 disabled:bg-blue-300">
                    Ajouter un commentaire
                </button>
            </form>
        </div>
    @endif
    <div class="mb-2 mt-4 text-xl font-bold">Commentaires</div>
    <div class="mb-4 space-y-2">
        @forelse ($comments as $comment)
            <div class="rounded-lg border border-blue-400 bg-blue-200 px-4 py-2 shadow-md">
                <div class="mb-1 text-xs">
                    {{ $comment->created_at->diffForHumans() }} Par
                    <span class="font-semibold">{{ $comment->user->name }}</span>
                </div>
                <div>
                    {{ $comment->message }}
                </div>
            </div>
        @empty
            <div class="rounded-lg border border-blue-400 bg-blue-200 px-4 py-2 shadow-md">
                Aucun commentaire trouvé !
            </div>
        @endforelse
    </div>
</div>
