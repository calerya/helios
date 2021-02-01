<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganismosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $dateFormat = 'd-m-Y';
    
    public function up()
    {
        Schema::create('organismos', function (Blueprint $table) {
            
            $table->id();
            $table->integer('proyecto_id')->index();
            $table->string('organismo','40');
            $table->string('num_expediente','50');
            $table->date('fec_presentacion')->nullable();
            $table->date('fec_requerimiento')->nullable();
            $table->date('fec_cont_requerimiento')->nullable();
            $table->date('fec_inicio_ip')->nullable();
            $table->date('fec_fin_ip')->nullable();
            $table->date('fec_resolucion')->nullable();
            $table->date('fec_publ_resolucion')->nullable();
            $table->date('fec_caducidad')->nullable();
            $table->date('fec_solic_prorroga')->nullable();
            $table->date('fec_concesion_pror')->nullable();
            $table->date('fec_solic_apm')->nullable();
            $table->date('fec_conc_apm')->nullable();
            $table->integer('num_prorrogas')->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('finalizado')->default(0);
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
        Schema::dropIfExists('organismos');
    }
}
