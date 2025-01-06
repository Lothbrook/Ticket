<?php

namespace App\Livewire;

use App\Models\Ticket;
use App\Models\Phone;
use App\Models\Stock;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DashboardHome extends Component
{
    public int $closedTickets = 0;
    public int $openTickets = 0;
    public int $totalTickets = 0;
    public int $totalphones = 0;
    public int $totalpc = 0;
    public int $phones = 0;
    public int $pc = 0;
    public int $phonearchived = 0;
    public int $pcarchived = 0;

    public function mount(): void
    {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            $this->closedTickets = Ticket::closed()->count();
            $this->openTickets = Ticket::open()->count();
            $this->phones = Phone::WhereNull('archive')->OrWhere('archive',false)->count();
            $this->pc = Stock::WhereNull('archive')->OrWhere('archive',false)->count();
        } elseif ($user->hasRole('Agent')) {
            $this->closedTickets = Ticket::assignedToAgent($user)->closed()->count();
            $this->openTickets = Ticket::assignedToAgent($user)->open()->count();
            $this->phones = Phone::WhereNull('archive')->OrWhere('archive',false)->OrWhere('user_id',auth()->user()->user_id)->count();
            $this->pc = Stock::WhereNull('archive')->OrWhere('archive',false)->OrWhere('user_id',auth()->user()->user_id)->count();
        } else {
            $this->closedTickets = Ticket::byUser($user)->closed()->count();
            $this->openTickets = Ticket::byUser($user)->open()->count();
            
        }

        $this->totalTickets = $this->closedTickets + $this->openTickets;
    }

    public function render(): View
    {
        return view('livewire.dashboard-home');
    }
}
