<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stocks_phone', function (Blueprint $table) {
            $table->string('prix_achat')->nullable();
            $table->date('date_mise_service')->nullable();
            $table->string('valeur_actuelle')->nullable();
            $table->string('commentaire')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stocks_phone', function (Blueprint $table) {
            $table->dropColumn('prix_achat');
            $table->dropColumn('date_mise_service');
            $table->dropColumn('valeur_actuelle');
            $table->dropColumn('commentaire');
        });
    }
};
