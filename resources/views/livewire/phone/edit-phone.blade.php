<div class="max-w-xl">
    <div class="mb-5 text-2xl font-bold">Modifier Téléphone</div>
    <form wire:submit.prevent="save" class="space-y-5">
        <div>
            <label for="name" class="mb-1 block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Nom</label>
            <input type="text" id="name" wire:model="name" @class([
                'block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50',
                'border-red-300 focus:border-red-300 focus:ring-red-200' => $errors->has('name'),
            ]) placeholder="Nom" />
            @error('name')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="date_achat" class="mb-1 block text-sm font-medium text-gray-700">Date Achat</label>
            <input type="date" id="date_achat" wire:model="date_achat" class="block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
        <div>
            <label for="date_mise_service" class="mb-1 block text-sm font-medium text-gray-700">Date de la mise en service</label>
            <input type="date" id="date_mise_service" wire:model="date_mise_service" class="block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
       
        <div>
            <label for="user_id" class="mb-1 block text-sm font-medium text-gray-700">Utilisateur</label>
            <select id="user_id" wire:model="user_id" class="block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">Selectionner l'Utilisateur</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="id_societe" class="mb-1 block text-sm font-medium text-gray-700">Société</label>
            <select id="id_societe" wire:model="id_societe" class="block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">Selectionner la sociéte</option>
                @foreach($societes as $societe)
                    <option value="{{ $societe->id }}">{{ $societe->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="departement_id" class="mb-1 block text-sm font-medium text-gray-700">Département</label>
            <select id="departement_id" wire:model="departement_id" class="block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">Selectionner la département</option>
                @foreach($departements as $departement)
                    <option value="{{ $departement->id }}">{{ $departement->nom_departement }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="id_category" class="mb-1 block text-sm font-medium text-gray-700">Catégorie</label>
            <select id="id_category" wire:model="id_category" class="block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">Selectionner la catégorie</option>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="modele" class="mb-1 block text-sm font-medium text-gray-700">Modele</label>
            <input type="text" id="modele" wire:model="modele" class="block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
        <div>
            <label for="marque" class="mb-1 block text-sm font-medium text-gray-700">Marque</label>
            <input type="text" id="marque" wire:model="marque" class="block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
        <div>
            <label for="serie" class="mb-1 block text-sm font-medium text-gray-700">N° Série</label>
            <input type="text" id="serie" wire:model="serie" class="block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
        <div>
            <label for="imei_1" class="mb-1 block text-sm font-medium text-gray-700">Imei 1</label>
            <input type="text" id="imei_1" wire:model="imei_1" class="block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
        <div>
            <label for="imei_2" class="mb-1 block text-sm font-medium text-gray-700">Imei 2</label>
            <input type="text" id="imei_2" wire:model="imei_2" class="block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
        <div>
            <label for="indicatif" class="mb-1 block text-sm font-medium text-gray-700">Etat</label>
            <select id="indicatif" wire:model="indicatif" class="block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">Etat</option>
                <option value="perdu">Perdu</option>
                <option value="casser">Casser</option>
                <option value="reparer">Reparer</option>
                <option value="attribuer">Attribue</option>
                <option value="stock">En Stock</option>
            </select>
        </div>
        <div>
            <label for="prix_achat" class="mb-1 block text-sm font-medium text-gray-700">Prix Achat</label>
            <input type="text" id="prix_achat" wire:model="prix_achat" class="block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
        
        <div>
            <label for="valeur_actuelle" class="mb-1 block text-sm font-medium text-gray-700">Valeur Actuelle</label>
            <input type="text" id="valeur_actuelle" wire:model="valeur_actuelle" class="block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
        <div>
            <label for="commentaire" class="mb-1 block text-sm font-medium text-gray-700">Commentaire</label>
            <textarea id="commentaire" wire:model="commentaire" class="block w-full rounded-md border-gray-300 shadow-sm"></textarea>
        </div>

        <button type="submit"
            class="rounded-lg border border-blue-950 bg-blue-950 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-blue-700 hover:bg-blue-700 focus:ring focus:ring-blue-200 disabled:cursor-not-allowed disabled:border-blue-300 disabled:bg-blue-300">
            Mettre à jour
        </button>
    </form>
</div>
