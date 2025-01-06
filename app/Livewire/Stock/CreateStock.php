<?php
namespace App\Livewire\Stock;

use App\Models\Stock;
use App\Models\User;
use App\Models\Societe;
use App\Models\CategoryStock;
use App\Models\Departement;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class CreateStock extends Component
{
    #[Validate([
        'name_composant' => 'required|min:3|max:255',
        // 'quantity' => 'integer',
        'date_achat' => 'date',
        // 'user_id' => 'exists:users,id',
        'caractere' => 'nullable|string|max:255',
        'modele' => 'nullable|string|max:255',
        'serial' => 'nullable|string|max:255',
        'id_equipement' => 'nullable|string|max:255|unique:stocks,id_equipement',
        'date_mise_en_service' => 'nullable|date',
        'garantie' => 'nullable|in:oui,non',
        'prix_achat' => 'nullable|numeric',
        'condition' => 'nullable|in:neuf,bon,occasion,stock',
        'anciennete' => 'nullable|integer',
        'valeur_actuelle' => 'nullable|numeric',
        'etat_garantie' => 'nullable|string|max:255',
        'commentaire' => 'nullable|string',
        'address_ip' => 'nullable|string',
        'marque' => 'nullable|string',
    ])]
    public string $name_composant = '';
    public ?int $user_id = null;
    public ?string $caractere = null;
    public ?string $modele = null;
    public ?string $serial = null;
    public ?string $id_equipement = null;
    public ?int $id_categorie = null;
    public ?string $date_mise_en_service = null;
    public ?string $garantie = null;
    public ?string $prix_achat = null;
    public ?string $condition = null;
    public ?int $anciennete = null;
    public ?string $valeur_actuelle = null;
    public ?string $etat_garantie = null;
    public ?string $commentaire = null;
    // public ?int $quantity = null;
    public ?string $date_achat = null;
    public ?int $id_societe = null;
    public ?string $address_ip = null;
    public ?string $marque = null;
    public ?int $id_departement = null;

    public $users;
    public $societes;
    public $categories;
    public $departement;


    public function mount()
    {
        $this->users = User::all();
        $this->societes = Societe::all();
        $this->categories = CategoryStock::where('type', 'pc')->get();
        $this->departement = Departement::all();
    }

    public function save(): Redirector|RedirectResponse
    {
        $this->validate();

        Stock::create([
            'name_composant' => $this->name_composant,
            // 'quantity' => $this->quantity,
            'id_societe' => $this->id_societe,
            'date_achat' => $this->date_achat,
            'user_id' => $this->user_id,
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
            'id_categorie' => $this->id_categorie,
            'address_ip' => $this->address_ip,
            'marque' => $this->marque,
            'id_departement' => $this->id_departement,
            'archive' => false,
        ]);

        return redirect()->route('stock.index')
            ->with('status', 'Composant ' . $this->name_composant . ' crée.');
    }

    public function render(): View
    {
        return view('livewire.stock.create-stock', [
            'users' => $this->users,
            'categories' => $this->categories,
            'societes' => $this->societes,
            'departements' => $this->departement,
        ]);
    }
}
