<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_supplementaire', function (Blueprint $table) {
            $table->id('id_supplementaire');
            $table->date('DateSys');
            $table->decimal('CoutParHeure', 8, 2);
            $table->time('DebutDeSuppl');
            $table->time('FinDeSuppl');
             $table->decimal('nb_total_heures', 5, 2);
            $table->decimal('cout_total', 10, 2);
            $table->unsignedBigInteger('Id_Employe');
            $table->timestamps();
            $table->foreign('Id_Employe')->references('Id_Employe')->on('employers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_supplementaire');
    }
};
