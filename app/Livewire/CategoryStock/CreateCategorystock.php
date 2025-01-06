<?php
namespace App\Livewire\Categorystock;

use App\Models\CategoryStock;
use App\Models\Stock;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class CreateCategorystock extends Component
{
    #[Validate([
        'nom_categorie' => 'required|min:3|max:255',
        'type' => 'nullable|in:pc,phone'
    ])]
    public string $nom_categorie = '';
    public ?string $type = null;

    public function save(): Redirector|RedirectResponse
    {
        $this->authorize('manage', Stock::class);

        $this->validate();

        CategoryStock::create([
            'nom_categorie' => $this->nom_categorie,
            'type' => $this->type,

        ]);

        return redirect()->route('category_stock.index')
            ->with('status', 'Catégorie ' . $this->nom_categorie . ' Crée.');
    }

    public function render(): View
    {
        return view('livewire.CategoryStock.create-categorystock');
    }
}
