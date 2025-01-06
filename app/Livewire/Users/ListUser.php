<?php

namespace App\Livewire\Users;

use App\Models\User;
use App\Models\Societe;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ListUser extends Component
{
    use WithPagination;

    public $search = '';
    public $societeFilter;


    public function deleteUser(User $user): void
    {
        $this->authorize('manage', $user);

        if (auth()->check() && auth()->user() == $user) {
            abort(403, 'You cannot delete your own account');
        }

        $name = $user->name;

        $user->delete();

        session()->flash('status', 'User ' . $name . ' Deleted!');
    }

    public function render(): View
    {   
        $users = User::query()
            ->when(!empty($this->societeFilter), function($query) {
                $query->where('id_societe', $this->societeFilter);
            })
            ->where(function ($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%')
                    ->orWhere('phone', 'like', '%'.$this->search.'%')
                    ->orWhereHas('societe', function ($query) {
                        $query->where('name', 'like', '%'.$this->search.'%');
                    });
            })
            ->with('societe')
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.users.list-user', [
            'users' => $users,
            'societes' => Societe::all(),
            'agents' => User::role('Agent')->get()
        ]);
    }

}
