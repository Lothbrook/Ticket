<?php

namespace App\Livewire\CategoryStock;

use App\Models\CategoryStock;
use App\Models\Stock;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ListCategorystock extends Component
{
    use WithPagination;

    public function deleteCategoryStock(CategoryStock $categorystock, Stock $stock): void
    {
        $this->authorize('manage', $stock);

        $nom_category = $categorystock->nom_category;

        $stock->delete();

        session()->flash('status', 'Category ' . $nom_category . ' Supprimée!');
    }

    public function render(): View
    {
        return view('livewire.CategoryStock.list-categorystock', [
            'stocks' => CategoryStock::orderBy('id')->paginate(10),
        ]);
    }
}
