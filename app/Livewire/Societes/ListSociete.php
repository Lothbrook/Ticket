<?php

namespace App\Livewire\Societes;

use App\Models\Societe;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ListSociete extends Component
{
    use WithPagination;

    public function deleteSociete(Societe $societe): void
    {
        
        $this->authorize('manage ', $societe);

        $name = $societe->name;
        $societe->delete();

        session()->flash('status', 'Societe ' . $name . ' Deleted!');
    }

    public function render(): View
    {
        return view('livewire.societes.list-societe', [
            'societes' => Societe::orderBy('id')->paginate(10),
        ]);
    }
}
