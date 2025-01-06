<?php
namespace App\Livewire\StockPhone;

use App\Models\Stock;
use App\Models\User;
use App\Models\Societe;
use App\Models\CategoryStock;
use App\Models\Phone;
use App\Models\Departement;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class CreatePhone extends Component
{
    #[Validate([
        'name' => 'required|min:3|max:255',
        'date_achat' => 'date',
        'date_mise_service' => 'date',
        
        'modele' => 'nullable|string|max:255',
        'serie' => 'nullable|string|max:255',
        'indicatif' => 'nullable|in:perdu,casser,reparer,attribuer,stock',
        'marque' => 'nullable|string',
        'imei_1' => 'nullable|string',
        'imei_2' => 'nullable|string',
        'commentaire' => 'nullable|string',
        'valeur_actuelle' => 'nullable|string',
        'prix_achat' => 'nullable|string',
        
    ])]
    public string $name = '';
    public ?int $user_id = null;
    public ?string $modele = null;
    public ?string $serie = null;
    public ?int $id_category = null;
    public ?string $date_achat = null;
    public ?int $id_societe = null;
    public ?int $departement_id = null;
    public ?string $marque = null;
    public ?string $imei_1 = null;
    public ?string $imei_2 = null;
    public ?string $indicatif = null;
    public ?string $date_mise_service = null;
    public ?string $commentaire = null;
    public ?string $valeur_actuelle = null;
    public ?string $prix_achat = null;

    public $users;
    public $societes;
    public $categories;


    public function mount()
    {
        $this->users = User::all();
        $this->societes = Societe::all();
        $this->categories = CategoryStock::where('type', 'phone')->get();
        $this->departements = Departement::all();
    }

    public function save(): Redirector|RedirectResponse
    {
        $this->validate();

        Phone::create([
            'name' => $this->name,
            'date_achat' => $this->date_achat,
            'user_id' => $this->user_id,
            'modele' => $this->modele,
            'serie' => $this->serie,
            'marque' => $this->marque,
            'imei_1' => $this->imei_1,
            'imei_2' => $this->imei_2,
            'id_societe' => $this->id_societe,
            'departement_id' => $this->departement_id,
            'id_category' => $this->id_category,
            'indicatif' => $this->indicatif,
            'commentaire' => $this->commentaire,
            'date_mise_service' => $this->date_mise_service,
            'valeur_actuelle' => $this->valeur_actuelle,
            'prix_achat' => $this->prix_achat,
        ]);

        return redirect()->route('phone.index')
            ->with('status', 'Téléphone ' . $this->name . ' crée.');
    }

    public function render(): View
    {
        return view('livewire.phone.create-phone', [
            'users' => $this->users,
            'categories' => $this->categories,
            'societes' => $this->societes,
            'departements' => $this->departements,
        ]);
    }
}
