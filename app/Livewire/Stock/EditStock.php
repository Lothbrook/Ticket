<?php

namespace App\Livewire\Stock;

use App\Models\Stock;
use App\Models\Societe;
use App\Models\User;
use App\Models\CategoryStock;
use App\Models\Departement;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class EditStock extends Component
{
    public Stock $stock;
    public string $name_composant = '';
    public string $date_achat;
    public ?int $id_societe = null;
    public ?int $id_categorie = null;
    public ?int $user_id = null;
    public ?string $caractere = null;
    public ?string $modele = null;
    public ?string $serial = null;
    public ?string $id_equipement = null;
    public ?string $date_mise_en_service = null;
    public ?string $garantie = null;
    public ?string $prix_achat = null;
    public ?string $condition = null;
    public ?int $anciennete = null;
    public ?string $valeur_actuelle = null;
    public ?string $etat_garantie = null;
    public ?string $commentaire = null;
    public ?string $address_ip = null;
    public ?string $marque = null;
    public ?int $id_departement = null;



    public $societes;
    public $categories;
    public $users;
    public $departement;

    public function mount(Stock $stock): void
    {
        $this->stock = $stock;
        $this->name_composant = $stock->name_composant;
        $this->date_achat = $stock->date_achat;
        $this->id_societe = $stock->id_societe;
        $this->id_categorie = $stock->id_categorie;
        $this->user_id = $stock->user_id;
        $this->caractere = $stock->caractere;
        $this->modele = $stock->modele;
        $this->serial = $stock->serial;
        $this->id_equipement = $stock->id_equipement;
        $this->date_mise_en_service = $stock->date_mise_en_service;
        $this->garantie = $stock->garantie;
        $this->prix_achat = $stock->prix_achat;
        $this->condition = $stock->condition;
        $this->anciennete = $stock->anciennete;
        $this->valeur_actuelle = $stock->valeur_actuelle;
        $this->etat_garantie = $stock->etat_garantie;
        $this->commentaire = $stock->commentaire;
        $this->address_ip = $stock->address_ip;
        $this->marque = $stock->marque;
        $this->id_departement = $stock->id_departement;


        $this->societes = Societe::all();
        $this->users = User::all();
        $this->categories = CategoryStock::where('type', 'pc')->get();
        $this->departement = Departement::all();
    }

    /**
     * @return array<string, array<string>>
     */
    public function rules(): array
    {
        return [
            'name_composant' => ['required', 'min:3', 'max:255'],
            'date_achat' => ['required', 'date'],
            'id_societe' => ['required', 'exists:societes,id'],
            'id_categorie' => ['required', 'exists:category_stock,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'id_departement' => ['nullable', 'exists:departement,id'],
            'caractere' => ['nullable', 'string', 'max:255'],
            'modele' => ['nullable', 'string', 'max:255'],
            'serial' => ['nullable', 'string', 'max:255'],
            'id_equipement' => ['nullable', 'string', 'max:255', 'unique:stocks,id_equipement,' . $this->stock->id],
            'date_mise_en_service' => ['nullable', 'date'],
            'garantie' => ['nullable', 'in:oui,non'],
            'prix_achat' => ['nullable', 'numeric'],
            'condition' => ['nullable', 'in:neuf,bon,occasion,stock'],
            'anciennete' => ['nullable', 'integer'],
            'valeur_actuelle' => ['nullable', 'numeric'],
            'etat_garantie' => ['nullable', 'string', 'max:255'],
            'commentaire' => ['nullable', 'string'],
            'address_ip' => ['nullable', 'string'],
            'marque' => ['nullable', 'string'],
        ];
    }

    public function save(): Redirector|RedirectResponse
    {
        $this->authorize('manage', $this->stock);

        $this->validate();

        $this->stock->update([
            'name_composant' => $this->name_composant,
            'date_achat' => $this->date_achat,
            'user_id' => $this->user_id,
            'id_societe' => $this->id_societe,
            'id_categorie' => $this->id_categorie,
            'caractere' => $this->caractere,
            'modele' => $this->modele,
            'serial' => $this->serial,
            'id_equipement' => $this->id_equipement,
            'date_mise_en_service' => $this->date_mise_en_service,
            'garantie' => $this->garantie,
            'prix_achat' => $this->prix_achat,
            'condition' => $this->condition,
            'anciennete' => $this->anciennete,
            'valeur_actuelle' => $this->valeur_actuelle,
            'etat_garantie' => $this->etat_garantie,
            'commentaire' => $this->commentaire,
            'address_ip' => $this->address_ip,
            'marque' => $this->marque,
            'id_departement' => $this->id_departement,

        ]);

        return redirect()->route('stock.index')
            ->with('status', 'Stock ' . $this->name_composant . ' updated.');
    }

    public function render(): View
    {
        return view('livewire.stock.edit-stock', [
            'users' => $this->users,
            'societes' => $this->societes,
            'categories' => $this->categories,
            'departements' => $this->departement,
        ]);
    }
}
