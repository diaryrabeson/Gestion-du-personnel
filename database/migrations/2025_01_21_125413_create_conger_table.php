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
    Schema::create('conger', function (Blueprint $table) {
        $table->id('id_Conge');
        $table->unsignedBigInteger('id_typeConge');
        $table->date('Date_debut');
        $table->date('Date_Fin');
        $table->unsignedBigInteger('Id_Employe');
       $table->enum('status', ['En attente', 'Approuvé', 'Rejeté'])->default('En attente');

        $table->integer('jours_ouvrables')->nullable();
        $table->text('commentaire')->nullable();
        $table->timestamps();

        $table->foreign('id_typeConge')->references('id_typeConge')->on('typeconger')->onDelete('cascade');
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
        Schema::dropIfExists('conger');
    }
};
