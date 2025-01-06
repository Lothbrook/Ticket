<?php

namespace App\Livewire\Users;

use App\Models\User;
use App\Models\Societe;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use Spatie\Permission\Models\Role;

class EditUser extends Component
{
    public User $user;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $role = '';
    public ?string $id_societe = null;
    public ?string $phone = null;

    /**
     * @return array<string, array<string>>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user)],
            'password' => ['sometimes', 'min:8', 'max:255'],
            'phone'=> ['nullable', 'min:10', 'max:13'],
            'role' => ['required', 'exists:roles,id'],
            'id_societe' => ['required', 'exists:societes,id'],
        ];
    }

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles()->first()->id;  /* @phpstan-ignore-line */
        $this->id_societe = $user->id_societe;
        $this->phone = $user->phone;
    }

    public function save(): Redirector|RedirectResponse
    {
        $this->authorize('manage', $this->user);

        $validated = $this->validate();
        if (! empty($validated['role'])) {
            $this->user->roles()->sync([$validated['role']]);
            unset($validated['role']);
        }

        $this->user->update($validated);

        return redirect()->route('users.index')
            ->with('status', 'User ' . $this->name . ' updated.');
    }

    public function render(): View
    {
        return view('livewire.users.edit-user', [
            'roles' => Role::all(),
            'societes' => Societe::all(),
        ]);
    }
}
