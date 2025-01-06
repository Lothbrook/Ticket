<?php

namespace App\Livewire\Societes;

use App\Models\Societe;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class EditSociete extends Component
{
    public Societe $societe;
    public string $name = '';

    public function mount(Societe $societe): void
    {
        $this->societe = $societe;
        $this->name = $societe->name;
    }

    /**
     * @return array<string, array<string>>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:3',
                'max:255',
            ],
        ];
    }

    public function save(): Redirector|RedirectResponse
    {
        $this->authorize('manage', $this->societe);

        $this->validate();

        $this->societe->update([
            'name' => $this->name,
        ]);

        return redirect()->route('societe.index')
            ->with('status', 'Societe ' . $this->name . ' updated.');
    }

    public function render(): View
    {
        return view('livewire.societes.edit-societe');
    }
}