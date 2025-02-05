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
    Schema::create('employers', function (Blueprint $table) {
    $table->id('Id_Employe');
    $table->string('NomEmp');
    $table->string('Prenom');
    $table->string('Adresse')->nullable();
    $table->string('mail')->unique();
    $table->string('Telephone')->nullable();
    $table->string('Photo')->nullable();
    $table->date('DatedeNaissance');
    $table->date('DateD_embauche');
    $table->unsignedBigInteger('Id_service'); // bigint unsigned pour correspondre à `id_service`
    $table->string('Service')->nullable();
    $table->integer('SoldeConger');
    $table->string('Genre')->nullable;
    $table->decimal('SalaireDeBase', 10, 2);
    $table->timestamps();

    // Définir la clé étrangère
    $table->foreign('Id_service')->references('id_service')->on('tb_service')->onDelete('cascade');

    $table->engine = 'InnoDB';

});

   
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
