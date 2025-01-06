<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryStock extends Model
{
    use HasFactory;

    protected $table = 'category_stock';

    protected $fillable = ['nom_categorie', 'type'];
}