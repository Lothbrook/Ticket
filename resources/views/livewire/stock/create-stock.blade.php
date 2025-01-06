<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8">
    <div class="mb-8 text-3xl font-bold text-gray-800 border-b pb-4">Créer un Matériel</div>
    <form wire:submit.prevent="save" class="space-y-8">
        <!-- Nom -->
        <div>
            <label for="name_composant" class="block text-sm font-semibold text-gray-700">
                <i class="fas fa-cogs mr-2"></i>Nom <span class="text-red-500">*</span>
            </label>
            <input type="text" id="name_composant" wire:model="name_composant"
                class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 @error('name_composant') border-red-500 focus:border-red-500 focus:ring-red-300 @enderror"
                placeholder="Nom de Composant">
            @error('name_composant')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Grid de champs -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            <!-- Caractéristique -->
            <div>
                <label for="caractere" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-list-alt mr-2"></i>Caractéristique
                </label>
                <input type="text" id="caractere" wire:model="caractere"
                    class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            <!-- Date Achat -->
            <div>
                <label for="date_achat" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-calendar-alt mr-2"></i>Date Achat
                </label>
                <input type="date" id="date_achat" wire:model="date_achat"
                    class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            <!-- Utilisateur -->
            <div>
                <label for="user_id" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-user mr-2"></i>Utilisateur
                </label>
                <select id="user_id" wire:model="user_id"
                    class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Sélectionner un utilisateur</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Société -->
            <div>
                <label for="id_societe" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-building mr-2"></i>Société
                </label>
                <select id="id_societe" wire:model="id_societe"
                    class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Sélectionner la société</option>
                    @foreach($societes as $societe)
                        <option value="{{ $societe->id }}">{{ $societe->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Département -->
            <div>
                <label for="id_departement" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-users mr-2"></i>Département
                </label>
                <select id="id_departement" wire:model="id_departement"
                    class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Sélectionner la département</option>
                    @foreach($departements as $departement)
                        <option value="{{ $departement->id }}">{{ $departement->nom_departement }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Catégorie -->
            <div>
                <label for="id_categorie" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-box mr-2"></i>Catégorie du matériel
                </label>
                <select id="id_categorie" wire:model="id_categorie"
                    class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Sélectionner la catégorie</option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Modèle -->
            <div>
                <label for="modele" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-cogs mr-2"></i>Modèle
                </label>
                <input type="text" id="modele" wire:model="modele"
                    class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            <!-- Marque -->
            <div>
                <label for="marque" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-cogs mr-2"></i>Marque
                </label>
                <input type="text" id="marque" wire:model="marque"
                    class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            <!-- N° Série -->
            <div>
                <label for="serial" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-barcode mr-2"></i>N° Série
                </label>
                <input type="text" id="serial" wire:model="serial"
                    class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            <!-- Adresse IP -->
            <div>
                <label for="address_ip" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-network-wired mr-2"></i>Adresse IP
                </label>
                <input type="text" id="address_ip" wire:model="address_ip"
                    class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            <!-- Réf Interne -->
            <div>
                <label for="id_equipement" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-hashtag mr-2"></i>Réf Interne
                </label>
                <input type="text" id="id_equipement" wire:model="id_equipement"
                    class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            <!-- Date Mise en Service -->
            <div>
                <label for="date_mise_en_service" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-calendar-check mr-2"></i>Date Mise en Service
                </label>
                <input type="date" id="date_mise_en_service" wire:model="date_mise_en_service"
                    class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            <!-- Garantie -->
            <div>
                <label for="garantie" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-shield-alt mr-2"></i>Garantie
                </label>
                <select id="garantie" wire:model="garantie"
                    class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Garantie</option>
                    <option value="oui">Oui</option>
                    <option value="non">Non</option>
                </select>
            </div>
            <!-- Prix Achat -->
            <div>
                <label for="prix_achat" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-dollar-sign mr-2"></i>Prix Achat
                </label>
                <input type="text" id="prix_achat" wire:model="prix_achat"
                    class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            <!-- Prix de vente -->
            <div>
                <label for="valeur_actuelle" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-dollar-sign mr-2"></i>Prix de vente
                </label>
                <input type="text" id="valeur_actuelle" wire:model="valeur_actuelle"
                    class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            </div>
            <!-- Condition -->
            <div>
                <label for="condition" class="block text-sm font-semibold text-gray-700">
                    <i class="fas fa-check-circle mr-2"></i>Condition
                </label>
                <select id="condition" wire:model="condition"
                    class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <option value="">Condition</option>
                    <option value="neuf">Neuf</option>
                    <option value="bon">Bon</option>
                    <option value="occasion">Occasion</option>
                    <option value="stock">Stock</option>
                </select>
            </div>
        </div>

        <!-- Commentaire en bas -->
        <div>
            <label for="commentaire" class="block text-sm font-semibold text-gray-700">
                <i class="fas fa-comments mr-2"></i>Commentaire
            </label>
            <textarea id="commentaire" wire:model="commentaire"
                class="mt-2 w-full rounded-lg border border-gray-300 bg-gray-50 p-3 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                placeholder="Ajouter un commentaire..."></textarea>
        </div>

        <!-- Bouton Sauvegarder -->
        <div class="text-center">
            <button type="submit"
                class="inline-flex items-center justify-center px-6 py-3 mt-4 font-medium text-white bg-blue-600 rounded-full hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                Sauvegarder
            </button>
        </div>
    </form>
</div>
