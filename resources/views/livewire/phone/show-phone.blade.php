<div x-data="{ isShowingLogs: false, isShowingComments: true }">
    <x-status />
    <div class="mb-5 text-2xl font-bold">Informations de Téléphone</div>
    <div class="rounded-lg border border-gray-200 bg-white shadow-md">
        <div class="grid grid-cols-6 gap-6 p-4">
            <div class="font-bold">Equipement</div>
            <div class="col-span-5"><strong>{{ ucfirst($phone->name) }}</strong></div>
            <div class="font-bold">Date achat</div>
            <div class="col-span-5">{{ $phone->date_achat }}</div>
            <div class="font-bold">Prix achat</div>
            <div class="col-span-5">{{ ucfirst($phone->prix_achat) }} DH</div>
            <div class="font-bold">Date Mise en service</div>
            <div class="col-span-5">{{ $phone->date_mise_service }}</div>
            <div class="font-bold">N° Série</div>
            <div class="col-span-5">{{ $phone->serie }}</div>
            <div class="font-bold">Imei 1</div>
            <div class="col-span-5">{{ $phone->imei_1 }}</div>
            <div class="font-bold">Société</div>
            <div class="col-span-5">{{ $phone->societe ? $phone->societe->name : 'Société non définie' }}</div>
            <div class="font-bold">Département</div>
            <div class="col-span-5">{{ $phone->departement ? $phone->departement->nom_departement : 'Département non définie' }}</div>
            <div class="font-bold">Utilisateur</div>
            <div class="col-span-5">{{ $phone->user ? $phone->user->name : 'Utilisateur non définie' }}</div>
            <div class="font-bold">Catégorie</div>
            <div class="col-span-5">{{ $phone->categorystock ? $phone->categorystock->nom_categorie : 'Catégorie non définie' }}</div>
            <div class="font-bold">Condition</div>
            <div class="col-span-5">
                <span @class([
                    'inline-flex items-center gap-1 rounded-full px-2 py-1 text-xs font-semibold',
                    'bg-blue-200 text-blue-700' => $phone->indicatif === 'attribue',
                    'bg-yellow-200 text-yellow-700' => $phone->indicatif ==='reparer',
                    'bg-rose-200 text-rose-700' => $phone->indicatif === 'casser',
                    'bg-red-200 text-red-700' => $phone->indicatif === 'perdu',
                    'bg-green-200 text-green-700' => $phone->indicatif === 'stock',
                ])>
                    {{ strtoupper($phone->indicatif) }}
                </span>
            </div>
            <div class="font-bold">Valeur actuelle</div>
            <div class="col-span-5">{{ $phone->valeur_actuelle }} DH</div>
            <div class="font-bold">Commentaires</div>
            <div class="col-span-5">{{ $phone->commentaire }}</div>
            

        </div>
    </div>
    
    
</div>
