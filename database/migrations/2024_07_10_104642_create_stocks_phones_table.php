<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks_phone', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date_achat')->nulable();
            $table->string('marque')->nulable();
            $table->string('modele')->nulable();
            $table->string('serie')->nulable();
            $table->string('imei_1')->nullable();
            $table->string('imei_2')->nullable(); // IMEI 2 peut être nullable si non disponible
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_societe');
            $table->unsignedBigInteger('id_category');
            $table->enum('indicatif', ['perdu', 'casser', 'reparer', 'attribuer']);
            $table->timestamps();

            // Définir les clés étrangères
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_societe')->references('id')->on('societes')->onDelete('cascade');
            $table->foreign('id_category')->references('id')->on('category_stock')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks_phone');
    }
}
