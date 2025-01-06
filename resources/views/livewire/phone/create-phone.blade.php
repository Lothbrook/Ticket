<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <div class="mb-8 text-3xl font-bold text-center text-blue-950">Créer Téléphone</div>
    <form wire:submit.prevent="save" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nom -->
            <div>
                <label for="name" class="mb-1 block text-sm font-medium text-gray-700">
                    <i class="fas fa-mobile-alt mr-2 text-blue-600"></i> Nom <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" wire:model="name" @class([
                    'block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50',
                    'border-red-300 focus:border-red-300 focus:ring-red-200' => $errors->has('name'),
                ]) placeholder="Nom" />
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date Achat -->
            <div>
                <label for="date_achat" class="mb-1 block text-sm font-medium text-gray-700">
                    <i class="fas fa-calendar-alt mr-2 text-blue-600"></i> Date Achat
                </label>
                <input type="date" id="date_achat" wire:model="date_achat" class="block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <!-- Date Mise en Service -->
            <div>
                <label for="date_mise_service" class="mb-1 block text-sm font-medium text-gray-700">
                    <i class="fas fa-calendar-check mr-2 text-blue-600"></i> Date de la mise en service
                </label>
                <input type="date" id="date_mise_service" wire:model="date_mise_service" class="block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <!-- Utilisateur -->
            <div>
                <label for="user_id" class="mb-1 block text-sm font-medium text-gray-700">
                    <i class="fas fa-user mr-2 text-blue-600"></i> Utilisateur
                </label>
                <select id="user_id" wire:model="user_id" class="block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Sélectionner l'utilisateur</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Société -->
            <div>
                <label for="id_societe" class="mb-1 block text-sm font-medium text-gray-700">
                    <i class="fas fa-building mr-2 text-blue-600"></i> Société
                </label>
                <select id="id_societe" wire:model="id_societe" class="block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Sélectionner la société</option>
                    @foreach($societes as $societe)
                        <option value="{{ $societe->id }}">{{ $societe->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Département -->
            <div>
                <label for="departement_id" class="mb-1 block text-sm font-medium text-gray-700">
                    <i class="fas fa-sitemap mr-2 text-blue-600"></i> Département
                </label>
                <select id="departement_id" wire:model="departement_id" class="block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Sélectionner le département</option>
                    @foreach($departements as $departement)
                        <option value="{{ $departement->id }}">{{ $departement->nom_departement }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Catégorie -->
            <div>
                <label for="id_category" class="mb-1 block text-sm font-medium text-gray-700">
                    <i class="fas fa-tags mr-2 text-blue-600"></i> Catégorie
                </label>
                <select id="id_category" wire:model="id_category" class="block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">Sélectionner la catégorie</option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Modèle -->
            <div>
                <label for="modele" class="mb-1 block text-sm font-medium text-gray-700">
                    <i class="fas fa-mobile-alt mr-2 text-blue-600"></i> Modèle
                </label>
                <input type="text" id="modele" wire:model="modele" class="block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <!-- Marque -->
            <div>
                <label for="marque" class="mb-1 block text-sm font-medium text-gray-700">
                    <i class="fas fa-trademark mr-2 text-blue-600"></i> Marque
                </label>
                <input type="text" id="marque" wire:model="marque" class="block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <!-- N° Série -->
            <div>
                <label for="serie" class="mb-1 block text-sm font-medium text-gray-700">
                    <i class="fas fa-hashtag mr-2 text-blue-600"></i> N° Série
                </label>
                <input type="text" id="serie" wire:model="serie" class="block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <!-- IMEI 1 -->
            <div>
                <label for="imei_1" class="mb-1 block text-sm font-medium text-gray-700">
                    <i class="fas fa-sim-card mr-2 text-blue-600"></i> IMEI 1
                </label>
                <input type="text" id="imei_1" wire:model="imei_1" class="block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <!-- IMEI 2 -->
            <div>
                <label for="imei_2" class="mb-1 block text-sm font-medium text-gray-700">
                    <i class="fas fa-sim-card mr-2 text-blue-600"></i> IMEI 2
                </label>
                <input type="text" id="imei_2" wire:model="imei_2" class="block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <!-- État -->
            <div>
                <label for="indicatif" class="mb-1 block text-sm font-medium text-gray-700">
                    <i class="fas fa-info-circle mr-2 text-blue-600"></i> État
                </label>
                <select id="indicatif" wire:model="indicatif" class="block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">État</option>
                    <option value="perdu">Perdu</option>
                    <option value="casser">Cassé</option>
                    <option value="reparer">Réparé</option>
                    <option value="attribuer">Attribué</option>
                    <option value="stock">En Stock</option>
                </select>
            </div>

            <!-- Prix Achat -->
            <div>
                <label for="prix_achat" class="mb-1 block text-sm font-medium text-gray-700">
                    <i class="fas fa-dollar-sign mr-2 text-blue-600"></i> Prix Achat
                </label>
                <input type="text" id="prix_achat" wire:model="prix_achat" class="block w-full rounded-md border-gray-300 shadow-sm" />
            </div>

            <!-- Valeur Actuelle -->
            <div>
                <label for="valeur_actuelle" class="mb-1 block text-sm font-medium text-gray-700">
                    <i class="fas fa-money-bill-wave mr-2 text-blue-600"></i> Valeur Actuelle
                </label>
                <input type="text" id="valeur_actuelle" wire:model="valeur_actuelle" class="block w-full rounded-md border-gray-300 shadow-sm" />
            </div>
            
            <!-- Commentaire -->
            <div class="md:col-span-2">
                <label for="commentaire" class="mb-1 block text-sm font-medium text-gray-700">
                    <i class="fas fa-comment-alt mr-2 text-blue-600"></i> Commentaire
                </label>
                <textarea id="commentaire" wire:model="commentaire" class="block w-full rounded-md border-gray-300 shadow-sm"></textarea>
            </div>
        </div>

        <!-- Bouton de soumission -->
        <div class="text-center mt-8">
            <button type="submit"
                class="inline-flex items-center rounded-lg border border-blue-950 bg-blue-950 px-6 py-3 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-blue-700 hover:bg-blue-700 focus:ring focus:ring-blue-200 disabled:cursor-not-allowed disabled:border-blue-300 disabled:bg-blue-300">
                <i class="fas fa-save mr-2"></i> Enregistrer
            </button>
        </div>
    </form>
</div>
