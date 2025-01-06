<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToStocksTable extends Migration
{
    public function up(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            if (!Schema::hasColumn('stocks', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            }
            if (!Schema::hasColumn('stocks', 'id_societe')) {
                $table->unsignedBigInteger('id_societe')->nullable();
                $table->foreign('id_societe')->references('id')->on('societes')->onDelete('set null');
            }
            if (!Schema::hasColumn('stocks', 'caractere')) {
                $table->string('caractere')->nullable();
            }
            if (!Schema::hasColumn('stocks', 'modele')) {
                $table->string('modele')->nullable();
            }
            if (!Schema::hasColumn('stocks', 'serial')) {
                $table->string('serial')->nullable();
            }
            if (!Schema::hasColumn('stocks', 'id_equipement')) {
                $table->string('id_equipement')->unique();
            }
            if (!Schema::hasColumn('stocks', 'date_mise_en_service')) {
                $table->date('date_mise_en_service')->nullable();
            }
            if (!Schema::hasColumn('stocks', 'garantie')) {
                $table->date('garantie')->nullable();
            }
            if (!Schema::hasColumn('stocks', 'prix_achat')) {
                $table->decimal('prix_achat', 15, 2)->nullable();
            }
            if (!Schema::hasColumn('stocks', 'condition')) {
                $table->enum('condition', ['neuf', 'bon', 'occasion'])->nullable();
            }
            if (!Schema::hasColumn('stocks', 'anciennete')) {
                $table->integer('anciennete')->nullable();
            }
            if (!Schema::hasColumn('stocks', 'valeur_actuelle')) {
                $table->decimal('valeur_actuelle', 15, 2)->nullable();
            }
            if (!Schema::hasColumn('stocks', 'etat_garantie')) {
                $table->string('etat_garantie')->nullable();
            }
            if (!Schema::hasColumn('stocks', 'commentaire')) {
                $table->text('commentaire')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            if (Schema::hasColumn('stocks', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
            if (Schema::hasColumn('stocks', 'id_societe')) {
                $table->dropForeign(['id_societe']);
                $table->dropColumn('id_societe');
            }
            if (Schema::hasColumn('stocks', 'caractere')) {
                $table->dropColumn('caractere');
            }
            if (Schema::hasColumn('stocks', 'modele')) {
                $table->dropColumn('modele');
            }
            if (Schema::hasColumn('stocks', 'serial')) {
                $table->dropColumn('serial');
            }
            if (Schema::hasColumn('stocks', 'id_equipement')) {
                $table->dropColumn('id_equipement');
            }
            if (Schema::hasColumn('stocks', 'date_mise_en_service')) {
                $table->dropColumn('date_mise_en_service');
            }
            if (Schema::hasColumn('stocks', 'garantie')) {
                $table->dropColumn('garantie');
            }
            if (Schema::hasColumn('stocks', 'prix_achat')) {
                $table->dropColumn('prix_achat');
            }
            if (Schema::hasColumn('stocks', 'condition')) {
                $table->dropColumn('condition');
            }
            if (Schema::hasColumn('stocks', 'anciennete')) {
                $table->dropColumn('anciennete');
            }
            if (Schema::hasColumn('stocks', 'valeur_actuelle')) {
                $table->dropColumn('valeur_actuelle');
            }
            if (Schema::hasColumn('stocks', 'etat_garantie')) {
                $table->dropColumn('etat_garantie');
            }
            if (Schema::hasColumn('stocks', 'commentaire')) {
                $table->dropColumn('commentaire');
            }
        });
    }
}
