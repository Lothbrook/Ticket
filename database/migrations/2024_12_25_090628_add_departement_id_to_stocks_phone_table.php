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
            $table->unsignedBigInteger('departement_id')->nullable()->after('id_societe'); // Place the column after 'societe_id'
            $table->foreign('departement_id')->references('id')->on('departement')->onDelete('set null'); // Define the foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stocks_phone', function (Blueprint $table) {
            $table->dropForeign(['departement_id']);
            $table->dropColumn('departement_id');
        });
    }
};
