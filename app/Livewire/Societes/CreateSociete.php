<?php
namespace App\Livewire\Societes;

use App\Models\Societe;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class CreateSociete extends Component
{
    #[Validate([
        'name' => 'required|min:3|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ])]
    public string $name = '';

    public function save(): Redirector|RedirectResponse
    {
        $this->authorize('manage', Societe::class);

        $this->validate();

        Societe::create([
            'name' => $this->name,

        ]);

        return redirect()->route('societe.index')
            ->with('status', 'societe ' . $this->name . ' created.');
    }

    public function render(): View
    {
        return view('livewire.societes.create-societe');
    } 
} 