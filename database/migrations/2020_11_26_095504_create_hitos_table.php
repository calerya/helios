<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    protected $dateFormat = 'd-m-Y';
    
    public function up()
    {
        Schema::create('hitos', function (Blueprint $table) {
            $table->id();
            $table->integer('proyecto_id')->index();
            $table->integer('hito_numero');
            // Fecha de solicitud a Industria
            $table->date('fec_sol_ind')->nullable();
            // Fecha de obtención de Industria
            $table->date('fec_obt_ind')->nullable();
            // Fecha comunicación a distribuidora
            $table->date('fec_com_dis')->nullable();
            // Fecha de contestación
            $table->date('fec_contest')->nullable();
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
        Schema::dropIfExists('hitos');
    }
}
