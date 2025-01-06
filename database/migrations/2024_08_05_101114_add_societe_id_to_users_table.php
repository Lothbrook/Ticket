<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocieteIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Ajouter la colonne id_societe
            $table->unsignedBigInteger('id_societe')->nullable();

            // Définir la clé étrangère
            $table->foreign('id_societe')->references('id')->on('societes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprimer la clé étrangère
            $table->dropForeign(['id_societe']);

            // Supprimer la colonne id_societe
            $table->dropColumn('id_societe');
        });
    }
}
