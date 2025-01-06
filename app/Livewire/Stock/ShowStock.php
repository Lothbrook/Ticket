<?php

namespace App\Livewire\Stock;

use App\Models\Stock;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

class ShowStock extends Component
{
    public Stock $stock;

    public function mount(Stock $stock): void
    {
        // Charger les relations 'societe', 'categorystock', 'user' avec le stock
        $this->stock = $stock->load('societe', 'categorystock', 'user','departement');
    }


    public function generatePdf($id)
    {
        $stock = Stock::findOrFail($id);

        $pdf = PDF::loadView('livewire.stock.pdf', compact('stock'));

        return $pdf->download('stock_' . $id . '.pdf');
    }

    public function generateQrCode($stockId)
    {
        $stock = Stock::with('societe', 'categorystock', 'user')->findOrFail($stockId);
        $url = route('stock.show', $stock->id);
        $qrCodeData = QrCode::size(400)->generate($url);

        return view('livewire.stock.show-barcode', [
            'stock' => $stock,
            'qrCodeData' => $qrCodeData,
        ]);
    }

    public function render(): View
    {
        $this->authorize('view', $this->stock);

        return view('livewire.stock.show-stock', [
            'stock' => $this->stock,
        ]);
    }
}
