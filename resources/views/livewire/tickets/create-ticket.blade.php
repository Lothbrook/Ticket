<div class="max-w-5xl mx-auto p-8 bg-white rounded-lg shadow-lg">
    <div class="mb-8 text-3xl font-extrabold text-gray-800">Créer un Nouveau Ticket</div>
    <form wire:submit.prevent="save" class="space-y-10">
        <!-- Première ligne : Titre et Priorité -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="space-y-2">
                <label for="title" class="block text-sm font-semibold text-gray-700">
                    Titre du Ticket <span class="text-red-500">*</span>
                </label>
                <input type="text" id="title" wire:model="form.title" 
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 
                    {{ $errors->has('form.title') ? 'border-red-500 focus:ring-red-300' : '' }}" 
                    placeholder="Titre du Ticket">
                @error('form.title')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="space-y-2">
                <label for="priority" class="block text-sm font-semibold text-gray-700">
                    Priorité <span class="text-red-500">*</span>
                </label>
                <select wire:model="form.priority" 
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
        </div>

        <!-- Description -->
        <div class="space-y-4">
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2 mt-2">
                Description <span class="text-red-500">*</span>
            </label>
            <textarea id="description" wire:model="form.description" rows="5" 
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 
                {{ $errors->has('form.description') ? 'border-red-500 focus:ring-red-300' : '' }}" 
                placeholder="Expliquez le problème..."></textarea>
            @error('form.description')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Catégories et Labels -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="space-y-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2 mt-2">Catégories</label>
                <div class="flex flex-wrap gap-4">
                    @foreach ($categories as $category)
                        <label class="inline-flex items-center space-x-2 text-sm">
                            <input type="checkbox" value="{{ $category->id }}" wire:model="form.selectedCategories" 
                                class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span>{{ $category->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="space-y-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2 mt-2">Labels</label>
                <div class="flex flex-wrap gap-4">
                    @foreach ($labels as $label)
                        <label class="inline-flex items-center space-x-2 text-sm">
                            <input type="checkbox" value="{{ $label->id }}" wire:model="form.selectedLabels" 
                                class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span>{{ $label->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Pièces jointes -->
        <div class="space-y-4">
            <label for="attachments" class="block text-sm font-semibold text-gray-700 mb-2 mt-2">Pièce jointe</label>
            <input id="attachments" type="file" wire:model="form.attachment" 
                class="block w-full rounded-md border-gray-300 shadow-sm focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50 file:mr-4 file:rounded-md file:border-0 file:bg-blue-500 file:px-4 file:py-2.5 file:text-white file:font-semibold hover:file:bg-blue-700">
            @error('form.attachment')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Bouton Envoyer -->
        <div class="text-right mt-2">
            <button type="submit" 
                class="inline-flex items-center px-6 py-3 rounded-md bg-blue-600 text-white font-semibold shadow-md hover:bg-blue-700 focus:ring focus:ring-blue-200 focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed">
                <i class="fas fa-paper-plane mr-2"></i> Envoyer
            </button>
        </div>
    </form>
</div>
