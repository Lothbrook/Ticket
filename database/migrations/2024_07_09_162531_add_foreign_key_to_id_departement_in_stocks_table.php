<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToIdDepartementInStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stocks', function (Blueprint $table) {
            // Vérifier si la colonne id_departement existe déjà
            if (!Schema::hasColumn('stocks', 'id_departement')) {
                // Ajouter la colonne id_departement si elle n'existe pas
                $table->unsignedBigInteger('id_departement')->nullable();
            }

            // Ajouter la contrainte de clé étrangère
            if (!Schema::hasColumn('stocks', 'id_departement')) {
                $table->unsignedBigInteger('id_departement')->nullable();
            }

            // Assurez-vous que la table 'departements' existe
            if (Schema::hasTable('departement')) {
                $table->foreign('id_departement')->references('id')->on('departement')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            // Supprimer la contrainte de clé étrangère
            $table->dropForeign(['id_departement']);
            // Supprimer la colonne id_departement
            $table->dropColumn('id_departement');
        });
    }
}
