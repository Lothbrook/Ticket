<?php
namespace App\Livewire\Departement;

use App\Models\Departement;
use App\Models\Stock;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class CreateDepartement extends Component
{
    #[Validate([
        'nom_departement' => 'required|min:3|max:255',
    ])]
    public string $nom_departement = '';

    public function save(): Redirector|RedirectResponse
    {
        $this->authorize('manage', Stock::class);

        $this->validate();

        Departement::create([
            'nom_departement' => $this->nom_departement,

        ]);

        return redirect()->route('departement.index')
            ->with('status', 'Departement ' . $this->nom_departement . ' crée.');
    }

    public function render(): View
    {
        return view('livewire.departement.create-departement');
    }
}
