<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresenceTable extends Migration // Assurez-vous que ce nom correspond
{
    public function up()
    {
        Schema::create('presence', function (Blueprint $table) {
            $table->id('id_presence');
            $table->date('DateSys'); // Date du pointage
            $table->enum('Etat', ['Présent', 'Absent'])->default('Absent'); // Etat de présence
            $table->unsignedBigInteger('Id_Employe'); // Employé concerné
            $table->string('motif')->nullable(); // Motif en cas d'absence
            $table->timestamps(); // Timestamps par défaut

            // Clé étrangère
            $table->foreign('Id_Employe')->references('Id_Employe')->on('employers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('presence');
    }
}
