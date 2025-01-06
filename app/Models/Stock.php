<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Societe;
use App\Models\CategoryStock;
use App\Models\User;
use App\Models\Departement;

class Stock extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_composant',
        // 'quantity',
        'date_achat',
        'user_id',
        'id_societe',
        'id_categorie',
        'caractere',
        'modele',
        'serial',
        'id_equipement',
        'date_mise_en_service',
        'garantie',
        'prix_achat',
        'condition',
        'anciennete',
        'valeur_actuelle',
        'etat_garantie',
        'commentaire',
        'address_ip',
        'marque',
        'id_departement',
        'archive',
    ];


    public function societe()
    {
        return $this->belongsTo(Societe::class, 'id_societe');
    }

    public function categorystock()
    {
        return $this->belongsTo(CategoryStock::class, 'id_categorie');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function departement()
    {
        return $this->belongsTo(Departement::class,'id_departement');
    }
    // Ajoutez les autres méthodes et relations du modèle ici si nécessaire

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(CategoryStock::class);
    }
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function societes(): BelongsTo
    {
        return $this->belongsTo(Societe::class);
    }

    public function scopeSearch(Builder $query, string $search): void
    {
        $query->where('name_composant', 'like', '%' . $search . '%')
            ->orWhere('caractere', 'like', '%' . $search . '%')
            ->orWhere('caractere', 'like', '%' . $search . '%')
            ->orWhereHas('user', function (Builder $query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('categories', function (Builder $query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
    }

}
