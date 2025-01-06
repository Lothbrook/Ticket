<?php

namespace App\Livewire\Departement;

use App\Models\Departement;
use App\Models\Stock;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class EditDepartement extends Component
{
    public Departement $departement;
    public Stock $stock;
    public string $nom_departement = '';

    public function mount(Departement $departement): void
    {
        $this->departement = $departement;
        $this->nom_departement = $departement->nom_departement;
    }

    /**
     * @return array<string, array<string>>
     */
    public function rules(): array
    {
        return [
            'nom_departement' => [
                'required',
                'min:3',
                'max:255',
            ],
        ];
    }

    public function save(): Redirector|RedirectResponse
    {
        $this->authorize('manage', Stock::class);

        $this->validate();

        $this->departement->update([
            'nom_departement' => $this->nom_departement,
        ]);

        return redirect()->route('departement.index')
            ->with('status', 'Departement ' . $this->nom_departement . ' Modifiée.');
    }

    public function render(): View
    {
        return view('livewire.departement.edit-departement');
    }
}
