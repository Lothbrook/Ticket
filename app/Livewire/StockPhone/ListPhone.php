<?php

namespace App\Livewire\StockPhone;

use App\Models\Phone;
use App\Models\Stock;
use App\Models\Societe;
use App\Models\CategoryStock;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use PhpOffice\PhpWord\TemplateProcessor;

class ListPhone extends Component
{
    use WithPagination;

    public $search;
    public $categoryFilter;
    public $societeFilter;

    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deletePhone(Phone $phone): void
    {
        $stock = Stock::class;
        $this->authorize('manage', $stock);

        $name = $phone->name;
        $phone->delete();

        session()->flash('status', 'Telephone ' . $name . ' Supprimé!');
    }

    public function render(): View
    {
        $phones = Phone::with('societe', 'categorystock', 'user', 'departement')
            ->where(function ($query) {
                $query->whereNull('archive')
                      ->orWhere('archive', false);
            })
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('serie', 'like', '%' . $this->search . '%')
                      ->orWhereHas('user', function ($q) {
                          $q->where('name', 'like', '%' . $this->search . '%');
                      });
            })
            ->when($this->categoryFilter, fn($query) => $query->where('id_category', $this->categoryFilter))
            ->when($this->societeFilter, fn($query) => $query->where('id_societe', $this->societeFilter))
            ->where(function ($query) {
                // Re-apply the archive condition to ensure only unarchived results are returned
                $query->whereNull('archive')
                      ->orWhere('archive', false);
            })
            ->orderBy('name')
            ->paginate(10);
        

        $categorystock = CategoryStock::where('type', 'phone')->get();
        $societes = Societe::all();

        return view('livewire.phone.list-phone', [
            'phones' => $phones,
            'categories' => $categorystock,
            'societes' => $societes,
        ]);
    }

    public function archivePhone($id)
    {
        $phone = Phone::find($id);
        if ($phone) {
            $phone->archive = true;
            $phone->save();
            return response()->json(['success' => 'Telephone archivé avec succès']);
        }
        return response()->json(['error' => 'Telephone non trouvé'], 404);
    }


    public function generateWordDocument($id)
    {
        $stock = Phone::with(['societe', 'categorystock', 'user', 'departement'])->findOrFail($id);
    
        // Chemin vers le fichier template
        $templatePath = public_path('disposition.docx');
    
        // Charger le fichier Word existant avec TemplateProcessor
        $templateProcessor = new TemplateProcessor($templatePath);
        $date = date('Y-m-d');
        $date_y = date('Y');
        $libelle = $stock->name; // Utiliser \n pour le saut de ligne
    
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
        $templateProcessor->setValue('nom_complet', $stock->user->name);
        $templateProcessor->setValue('date', $date);
        $templateProcessor->setValue('date_y', $date_y);
        $templateProcessor->setValue('departement', $stock->departement->nom_departement ?? '.................');
        $templateProcessor->setValue('date_mise_service', $stock->date_mise_service);
        $templateProcessor->setValue('libelle', $stock->modele);
        $templateProcessor->setValue('marque', $stock->marque);
        $templateProcessor->setValue('serie', $stock->serie);
        $templateProcessor->setValue('societe', $stock->user->societe->name);
    
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
}
