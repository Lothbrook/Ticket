<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Departement extends Model
{
    use HasFactory;
    protected $table = 'departement';
    /** Fillables */
    protected $fillable = [
        'nom_departement',
    ];

}