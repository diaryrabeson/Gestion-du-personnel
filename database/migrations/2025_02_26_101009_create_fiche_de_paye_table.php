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
          Schema::create('ficheDePaye', function (Blueprint $table) {
            $table->id('id_fiche');
            $table->unsignedBigInteger('Id_Employe'); // Clé étrangère vers employé
            $table->unsignedBigInteger('id_presence'); // Clé étrangère vers présence
            $table->unsignedBigInteger('id_supplementaire'); // Clé étrangère vers heures supp.
            $table->decimal('salaire_base', 10, 2);
            $table->decimal('prime', 10, 2)->default(0);
            $table->decimal('total_heures_supp', 10, 2)->default(0);
            $table->decimal('total_presence', 10, 2)->default(0);
            $table->decimal('total_absence', 10, 2)->default(0);
            $table->decimal('salaire_total', 10, 2);
            $table->timestamps();
            
            $table->foreign('Id_Employe')->references('Id_Employe')->on('employers')->onDelete('cascade');
            $table->foreign('id_presence')->references('id_presence')->on('presence')->onDelete('cascade');
            $table->foreign('id_supplementaire')->references('id_supplementaire')->on('tb_supplementaire')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('ficheDePaye');
    }
};
