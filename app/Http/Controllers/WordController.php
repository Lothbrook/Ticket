<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class WordController extends Controller
{
    public function generateWordDocument($id)
    {
        $stock = Stock::with(['societe', 'categorystock', 'user'])->findOrFail($id);

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addTitle('Détails du Stock', 1);
        $section->addText('Nom du composant : ' . $stock->name_composant);
        $section->addText('Date d\'achat : ' . $stock->date_achat);
        $section->addText('Date de mise en service : ' . $stock->date_mise_en_service);
        $section->addText('Caractéristique : ' . $stock->caractere);
        $section->addText('Référence interne : ' . $stock->id_equipement);
        $section->addText('Société : ' . ($stock->societe->name ?? 'Société non définie'));
        $section->addText('Catégorie : ' . ($stock->categorystock->nom_categorie ?? 'Catégorie non définie'));
        $section->addText('Utilisateur : ' . ($stock->user->name ?? 'Utilisateur non défini'));

        $fileName = 'stock_details_' . $id . '.docx';
        $filePath = public_path($fileName);

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
