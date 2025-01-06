<div>
    <x-status />
    <div class="mb-5 text-2xl font-bold">Log Information</div>
    <div class="rounded-lg border border-gray-200 bg-white shadow-md">
        <div class="grid grid-cols-6 gap-6 p-4">
            <div class="font-bold">Titre du ticket</div>
            <div class="col-span-5">
                {{ ucfirst($log->subject->title ?? 'Sans titre') }}
            </div>
            <div class="font-bold">Description</div>
            <div class="col-span-5">
                {{ ucfirst($log->description) }}
            </div>
            <div class="font-bold">Causé par</div>
            <div class="col-span-5">
                {{ $log->causer?->name }}
            </div>
            <div class="font-bold">Créé</div>
            <div class="col-span-5">
                {{ $log->created_at->diffForHumans() }}
            </div>
            <hr class="col-span-full">
            <div class="font-bold">Attributs :</div>
            <pre class="col-span-5 overflow-auto">{{ json_encode(json_decode($log->changes, true), JSON_PRETTY_PRINT) }}</pre>
        </div>
    </div>
</div>
