<?php

namespace App\Livewire\StockPhone;

use App\Models\Phone;
use App\Models\Stock;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ShowPhone extends Component
{
    public Phone $phone;
    public Stock $stock;

    public function mount(Phone $phone): void
    {
        // Charger les relations 'societe', 'categorystock', 'user' avec le stock
        $this->phone = $phone->load('societe', 'categorystock', 'user', 'departement');
    }



    public function render(Stock $stock): View
    {
        $this->authorize('view', $stock);

        return view('livewire.phone.show-phone', [
            'phone' => $this->phone,
        ]);
    }
}
