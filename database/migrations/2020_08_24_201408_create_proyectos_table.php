<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            
            $table->id();
            $table->string('nom_proyecto','50');
            $table->integer('users_id')->index();
            $table->string('provincia','30');
            $table->string('term_municipal','40');
            $table->string('sociedad','40');
          //  $table->smallInteger('hitos')->default(0);
            $table->boolean('finalizado')->default(0);
            $table->date('fec_finalizacion')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
}
