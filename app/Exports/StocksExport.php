<?php

namespace App\Exports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StocksExport implements FromCollection, WithHeadings
{
    protected $fields;
    protected $stockIds;

    public function __construct(array $fields, array $stockIds)
    {
        $this->fields = $fields;
        $this->stockIds = $stockIds;
    }

    public function collection()
    {
        // Select all fields based on $fields array
        return Stock::whereIn('id', $this->stockIds)->get($this->fields);
    }

    public function headings(): array
    {
        // Adjust headings based on fields selected
        $headings = [];

        if (in_array('name_composant', $this->fields)) {
            $headings[] = 'Equipement';
        }
        if (in_array('date_achat', $this->fields)) {
            $headings[] = 'Date d\'achat';
        }
        if (in_array('date_mise_en_service', $this->fields)) {
            $headings[] = 'Date M.E.Service';
        }
        if (in_array('caractere', $this->fields)) {
            $headings[] = 'Caractéristique';
        }
        if (in_array('id_equipement', $this->fields)) {
            $headings[] = 'Ref Interne';
        }
        if (in_array('societe', $this->fields)) {
            $headings[] = 'Société';
        }
        if (in_array('categorystock', $this->fields)) {
            $headings[] = 'Catégorie';
        }
        if (in_array('user', $this->fields)) {
            $headings[] = 'Utilisateur';
        }

        return $headings;
    }
}
