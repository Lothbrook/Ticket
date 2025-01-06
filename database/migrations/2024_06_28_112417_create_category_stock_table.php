<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryStockTable extends Migration
{
    public function up()
    {
        Schema::create('category_stock', function (Blueprint $table) {
            $table->id();
            $table->string('nom_categorie');
            $table->enum('type', ['pc', 'phone']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_stock');
    }
}
