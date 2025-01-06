<?php

namespace App\Livewire\Archive;

use App\Models\Stock;
use App\Models\Phone;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;


class ArchiveList extends Component
{
    use WithPagination;

    public function render(): View
    {
        $stocks = Stock::with('societe', 'categorystock', 'user')
            ->where('archive',true)
            ->orderBy('name_composant')
            ->paginate(10);

        $phone = Phone::with('societe', 'categorystock', 'user')
            ->where('archive',true)
            ->orderBy('name')
            ->paginate(10);
        

        return view('livewire.stock.archive', [
            'stocks' => $stocks,
            'phone' => $phone,
        ]);
    }
}