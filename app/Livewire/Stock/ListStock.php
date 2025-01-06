<?php

namespace App\Livewire\Stock;

use App\Models\Stock;
use App\Models\Phone;
use App\Models\CategoryStock;
use App\Models\Societe;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StocksExport;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Log;
use Dompdf\Dompdf;
use Mpdf\Mpdf;
use Dompdf\Options;
use Ilovepdf\Ilovepdf;
use GuzzleHttp\Client;


class ListStock extends Component
{
    use WithPagination;

    public $selectedStocks = [];
    public $fieldsToExport = [];
    public $categoryFilter;
    public $garantieFilter;
    public $etatGarantieFilter;
    public $search;
    public $societeFilter;


    public function deleteStock(Stock $stock): void
    {
        $this->authorize('manage', $stock);

        $nameComposant = $stock->name_composant;

        $stock->delete();

        session()->flash('status', 'Stock ' . $nameComposant . ' Deleted!');
    }


    public function exportSelected()
    {
        // Validation or adjustments as needed
        if (empty($this->fieldsToExport)) {
            session()->flash('error', 'Please select at least one field to export.');
            return;
        }

        // Call Excel export
        return Excel::download(new StocksExport($this->fieldsToExport, $this->selectedStocks), 'stocks.xlsx');
    }




    public function render(): View
    {
        $stocks = Stock::with('societe', 'categorystock', 'user')
            ->whereNull('archive')
            ->orWhere('archive', false)
            ->when($this->categoryFilter, fn($query) => $query->where('id_categorie', $this->categoryFilter))
            ->when($this->societeFilter, fn($query) => $query->where('id_societe', $this->societeFilter))
            ->when($this->garantieFilter, fn($query) => $query->where('garantie', $this->garantieFilter))
            ->when($this->etatGarantieFilter, fn($query) => $query->where('etat_garantie', $this->etatGarantieFilter))
            ->when($this->search, function($query) {
                $query->where('name_composant', 'like', '%' . $this->search . '%')
                      ->orWhere('id_equipement', 'like', '%' . $this->search . '%')
                      ->orWhereHas('user', function($q) {
                          $q->where('name', 'like', '%' . $this->search . '%');
                      });
            })
            ->orderBy('name_composant')
            ->paginate(10);
        
        $societes = Societe::all();
        $categorystock = CategoryStock::all();
        
        return view('livewire.stock.list-stock', [
            'stocks' => $stocks,
            'societes' => $societes,
            'categorystock' => $categorystock,
        ]);
    }

    public function generateWordDocument($id)
    {
        $stock = Stock::with(['societe', 'categorystock', 'user', 'departement'])->findOrFail($id);
    
        // Chemin vers le fichier template
        $templatePath = public_path('disposition.docx');
    
        // Charger le fichier Word existant avec TemplateProcessor
        $templateProcessor = new TemplateProcessor($templatePath);
        $date = date('Y-m-d');
        $date_y = date('Y');
        $libelle = $stock->name_composant . "\n" . $stock->caractere; // Utiliser \n pour le saut de ligne
    
        // Récupérer le logo dynamique
        $logoPath = public_path('logo-sofimed.png'); // Chemin par défaut
        if ($stock->societe && $stock->user->societe->logo) {
            $logoPath = public_path($stock->user->societe->logo);
        }
    
        // Vérifier si le fichier existe
        if (!file_exists($logoPath)) {
            $logoPath = public_path('logo-sofimed.png'); // Utiliser un logo par défaut si le fichier n'existe pas
        }
    
        // Remplacer les variables dans le document par les valeurs de la base de données
        $templateProcessor->setValue('nom_complet', $stock->user->name ?? '.................');
        $templateProcessor->setValue('date', $date ?? '.................');
        $templateProcessor->setValue('date_y', $date_y ?? '....');
        $templateProcessor->setValue('departement', $stock->departement->nom_departement ?? '.................');
        $templateProcessor->setValue('date_mise_service', $stock->date_mise_en_service ?? '.................');
        $templateProcessor->setValue('libelle', $libelle ?? '.................');
        $templateProcessor->setValue('marque', $stock->marque ?? '.................');
        $templateProcessor->setValue('serie', $stock->serial ?? '.................' );
        $templateProcessor->setValue('societe', $stock->user->societe->name ?? '.................');
    
        // Ajouter le logo dynamique
        $templateProcessor->setImageValue('logo', [
            'path' => $logoPath,
            'width' => 150,  // Ajustez la largeur selon vos besoins
            'height' => 100, // Ajustez la hauteur selon vos besoins
        ]);
    
        $fileName = 'stock_details_' . $id . '.docx';
        $filePath = public_path($fileName);
    
        // Sauvegarder le fichier modifié
        $templateProcessor->saveAs($filePath);
    
        // Télécharger le fichier et le supprimer après l'envoi
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    


    public function archiveStock($id)
    {
        $stock = Stock::find($id);
        if ($stock) {
            $stock->archive = true;
            $stock->save();
            return response()->json(['success' => 'Stock archived successfully']);
        }
        return response()->json(['error' => 'Stock not found'], 404);
    }

    

}
