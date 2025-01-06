<?php

namespace App\Livewire\CategoryStock;

use App\Models\CategoryStock;
use App\Models\Stock;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class EditCategorystock extends Component
{
    public CategoryStock $categorystock;
    public string $nom_category = '';
    public string $type = '';
    

    public function mount(CategoryStock $categorystock): void
    {
        $this->categorystock = $categorystock;
        $this->nom_category = $categorystock->nom_categorie;
        $this->type = $categorystock->type;
    }

    /**
     * @return array<string, array<string>>
     */
    public function rules(): array
    {
        return [
            'nom_category' => [
                'required',
                'min:3',
                'max:255',
            ],
            'type' => ['required', 'in:pc,phone'],
        ];
    }

    public function save(): Redirector|RedirectResponse
    {
        $stock = Stock::class;
        $this->authorize('manage', $stock);

        $this->validate();

        $this->categorystock->update([
            'nom_categorie' => $this->nom_category,
            'type' => $this->type,
        ]);

        return redirect()->route('category_stock.index')
            ->with('status', 'La catégorie ' . $this->nom_category . 'a été Modifer.');
    }

    public function render(): View
    {
        return view('livewire.CategoryStock.edit-categorystock');
    }
}
