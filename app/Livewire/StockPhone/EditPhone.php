<?php

namespace App\Livewire\StockPhone;

use App\Models\Stock;
use App\Models\Societe;
use App\Models\User;
use App\Models\CategoryStock;
use App\Models\Phone;
use App\Models\Departement;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class EditPhone extends Component
{
    public Phone $phone;
    public Stock $stock;


    public string $name = '';
    public string $date_achat;
    public ?int $id_societe = null;
    public ?int $departement_id = null;
    public ?int $id_category = null;
    public ?int $user_id = null;
    public ?string $imei_1 = null;
    public ?string $imei_2 = null;
    public ?string $modele = null;
    public ?string $serie = null;
    public ?string $marque = null;
    public ?string $indicatif = null;




    public $societes;
    public $categories;
    public $users;
    public $departements;

    public function mount(Phone $phone): void
    {   
        $this->phone = $phone;
        $this->name = $phone->name;
        $this->date_achat = $phone->date_achat;
        $this->id_societe = $phone->id_societe;
        $this->departement_id = $phone->departement_id;
        $this->id_category = $phone->id_category;
        $this->user_id = $phone->user_id;
        $this->modele = $phone->modele;
        $this->serie = $phone->serie;
        $this->imei_1 = $phone->imei_1;
        $this->imei_2 = $phone->imei_2;
        $this->marque = $phone->marque;
        $this->indicatif = $phone->indicatif;


        $this->societes = Societe::all();
        $this->users = User::all();
        $this->departements = Departement::all();
        $this->categories = CategoryStock::where('type', 'phone')->get();
    }

    /**
     * @return array<string, array<string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'date_achat' => ['required', 'date'],
            'id_societe' => ['required', 'exists:societes,id'],
            'id_category' => ['required', 'exists:category_stock,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'modele' => ['nullable', 'string', 'max:255'],
            'serie' => ['nullable', 'string', 'max:255'],
            'imei_1' => ['nullable', 'string'],
            'imei_2' => ['nullable', 'string'],
            'indicatif' => ['nullable', 'string'],
            'marque' => ['nullable', 'string'],
        ];
    }

    public function save(): Redirector|RedirectResponse
    {
        $this->authorize('manage stock');

        $this->validate();

        $this->phone->update([
            'name' => $this->name,
            'date_achat' => $this->date_achat,
            'user_id' => $this->user_id,
            'id_societe' => $this->id_societe,
            'departement_id' => $this->departement_id,
            'id_category' => $this->id_category,
            'indicatif' => $this->indicatif,
            'modele' => $this->modele,
            'serie' => $this->serie,
            'imei_1' => $this->imei_1,
            'imei_2' => $this->imei_2,
            'marque' => $this->marque,

        ]);

        return redirect()->route('phone.index')
            ->with('status', 'Téléphone ' . $this->name . ' Modifié.');
    }

    public function render(): View
    {
        return view('livewire.phone.edit-phone', [
            'users' => $this->users,
            'societes' => $this->societes,
            'categories' => $this->categories,
            'departements' => $this->departements,
        ]);
    }
}
