<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFincasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fincas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained();
            $table->string('ref_catastral','20')->nullable();
            
            // Datos recogidos del catastro
            $table->string('provincia','100')->nullable();
            $table->string('municipio','100')->nullable();
            $table->string('zona','100')->nullable();
            $table->string('poligono' ,'10')->nullable();
            $table->string('parcela','10')->nullable();
            $table->string('uso','50')->nullable();
            // fin datos catastro
            
            $table->string('venta_alq','10')->nullable();
            $table->decimal('sup_catastral_ha',9,4)->nullable();
            $table->decimal('sup_util_ha',9,4)->nullable();
            $table->text('observaciones')->nullable();
            
            $table->softDeletes()->nullable();

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
        Schema::dropIfExists('fincas');
    }
}
