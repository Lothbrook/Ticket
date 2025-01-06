<?php

namespace App\Livewire\Departement;

use App\Models\Departement;
use App\Models\Stock;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ListDepartement extends Component
{
    use WithPagination;

    public function deleteDepartement(Stock $stock, Departement $departement): void
    {
        
        $this->authorize('manage ', $stock);

        $nom_departement = $departement->nom_departement;
        $departement->delete();

        session()->flash('status', 'Departement ' . $nom_departement . ' Supprimée!');
    }

    public function render(): View
    {
        return view('livewire.departement.list-departement', [
            'departement' => Departement::orderBy('id')->paginate(10),
        ]);
    }
}
